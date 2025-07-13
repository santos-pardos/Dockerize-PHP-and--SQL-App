// Jenkinsfile for Dockerized PHP/SQL App Deployment

pipeline {
    agent any

    environment {
        // AWS ECR details
        AWS_ACCOUNT_ID = '442042544656' // e.g., 123456789012
        AWS_REGION = 'us-east-1'         // e.g., ap-south-1
        ECR_REPO_NAME = 'php-sql-app'
        IMAGE_TAG = "${env.BUILD_NUMBER}" // Use Jenkins build number as image tag

        // Application deployment details
        APP_SERVER_USER = 'admin' // or 'ec2-user' if Amazon Linux
        APP_SERVER_IP = '172.31.86.120' // Private IP of your php-app-server EC2
        APP_SSH_CREDENTIALS_ID = 'app-server-ssh-key' // ID of the Jenkins credential you created

        // Environment variables for docker-compose (from your .env)
        PHP_APP_PORT = '8899'
        DB_PORT = '3307'
        MYSQL_DATABASE = 'elearn'
        MYSQL_USER = 'devops'
        MYSQL_PASSWORD = '123devops'
        MYSQL_ROOT_PASSWORD = 'SuperSecureRootPass123'
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'main', url: 'https://github.com/janak0ff/Dockerize-PHP-and--SQL-App.git'
                echo "Code checked out from branch: ${env.GIT_BRANCH}"
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    // Login to ECR - Uses the IAM role attached to the Jenkins EC2 instance
                    sh "aws ecr get-login-password --region ${AWS_REGION} | docker login --username AWS --password-stdin ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com"

                    // Build the Docker image
                    sh "docker build -t ${ECR_REPO_NAME}:${IMAGE_TAG} ."
                    sh "docker tag ${ECR_REPO_NAME}:${IMAGE_TAG} ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com/${ECR_REPO_NAME}:${IMAGE_TAG}"
                }
            }
        }

        stage('Push Docker Image to ECR') {
            steps {
                script {
                    sh "docker push ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com/${ECR_REPO_NAME}:${IMAGE_TAG}"
                    echo "Docker image pushed to ECR: ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com/${ECR_REPO_NAME}:${IMAGE_TAG}"
                }
            }
        }

        stage('Deploy to EC2') {
            steps {
                script {
                    // Use the SSH Agent to provide the private key for the app server
                    sshagent(credentials: [APP_SSH_CREDENTIALS_ID]) {
                        // Create a temporary directory on the app server to copy files
                        sh "ssh -o StrictHostKeyChecking=no ${APP_SERVER_USER}@${APP_SERVER_IP} 'mkdir -p /home/${APP_SERVER_USER}/app_deployment_temp'"

                        // Copy docker-compose.yml and .env to the app server
                        sh "scp -o StrictHostKeyChecking=no docker-compose.yml ${APP_SERVER_USER}@${APP_SERVER_IP}:/home/${APP_SERVER_USER}/app_deployment_temp/"
                        sh "scp -o StrictHostKeyChecking=no .env ${APP_SERVER_USER}@${APP_SERVER_IP}:/home/${APP_SERVER_USER}/app_deployment_temp/"
                        sh "scp -o StrictHostKeyChecking=no elearn.sql ${APP_SERVER_USER}@${APP_SERVER_IP}:/home/${APP_SERVER_USER}/app_deployment_temp/"


                        // SSH into the app server and perform deployment
                        sh """
                            ssh -o StrictHostKeyChecking=no ${APP_SERVER_USER}@${APP_SERVER_IP} <<EOF
                            # Navigate to the temporary deployment directory
                            cd /home/${APP_SERVER_USER}/app_deployment_temp

                            # Login to ECR on the app server
                            aws ecr get-login-password --region ${AWS_REGION} | docker login --username AWS --password-stdin ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com

                            # Pull the latest image
                            docker pull ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com/${ECR_REPO_NAME}:${IMAGE_TAG}

                            # Replace placeholder in docker-compose.yml with actual image tag
                            # This creates a new compose file with the correct image
                            sed "s|image: .*\$|image: ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com/${ECR_REPO_NAME}:${IMAGE_TAG}|g" docker-compose.yml > docker-compose-deploy.yml

                            # Stop and remove old containers (if any)
                            docker-compose -f docker-compose-deploy.yml down || true

                            # Start new containers with the latest image
                            # Use the copied .env file for environment variables
                            docker-compose -f docker-compose-deploy.yml up -d

                            # Clean up old images (optional, but good practice)
                            docker system prune -f

                            echo "Deployment complete for image tag: ${IMAGE_TAG}"
EOF
                        """
                    }
                }
            }
        }
    }

    post {
        always {
            echo 'Pipeline finished.'
        }
        success {
            echo 'Pipeline succeeded!'
            // Optionally add email/Slack notifications here
        }
        failure {
            echo 'Pipeline failed! Check console output for errors.'
            // Optionally add email/Slack notifications here
        }
        cleanup {
            // Clean up workspace on Jenkins agent after build
            deleteDir()
        }
    }
}