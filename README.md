## ✅ Folder Structure

```bash
my-php-sql-app/
├── Dockerfile
├── docker-compose.yml
├── .env
├── index.php
└── elearn.sql #db file for the app
```

---

## 🐳 `Dockerfile` (for PHP + Apache)

```Dockerfile
FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y git && \
    docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

EXPOSE 80

RUN a2enmod rewrite

CMD ["apache2-foreground"]
```

---

### 📘 Explanation of Each Line

| Line                                               | Description                                                                                                                                |
| -------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| `FROM php:8.1-apache`                              | Uses an official Docker image that includes PHP 8.1 and Apache. This is the base for your PHP web server.                                  |
| `RUN apt-get update && apt-get install -y git ...` | Updates package lists, installs `git`, and installs PHP extensions (`mysqli`, `pdo`, `pdo_mysql`) for MySQL/MariaDB database connectivity. |
| `COPY . /var/www/html/`                            | Copies all files from your current local directory into the Apache web root (`/var/www/html`) inside the container.                        |
| `EXPOSE 80`                                        | Informs Docker that the container will use port 80 (Apache default HTTP port).                                                             |
| `RUN a2enmod rewrite`                              | Enables Apache’s URL rewriting module, required by many PHP frameworks like Laravel or CodeIgniter.                                        |
| `CMD ["apache2-foreground"]`                       | Starts Apache in the foreground so the container stays alive and serves HTTP requests.                                                     |


---

## 🧱 `docker-compose.yml`

```yaml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "${APP_PORT}:80"
    volumes:
      - .:/var/www/html/
    depends_on:
      db:
        condition: service_healthy
    environment:
      MYSQL_HOST: db
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}

  db:
    image: mariadb:10.6
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}
    volumes:
      - db_data:/var/lib/mysql
      - ./elearn.sql:/docker-entrypoint-initdb.d/elearn.sql
    healthcheck:
      test: ["CMD", "mariadb-admin", "ping", "-h", "localhost"]
      interval: 10s
      timeout: 5s
      retries: 5
      start_period: 30s
    ports:
      - "${DB_PORT}:3306"

volumes:
  db_data:
```

---

### 📘 Explanation of Each Section

| Section          | Description                                                     |
| ---------------- | --------------------------------------------------------------- |
| `version: '3.8'` | Specifies the version of Docker Compose file format being used. |
| `services:`      | Defines the application services (containers) to be run.        |

---

#### 🔹 `web` Service (PHP + Apache)

| Key           | Description                                                                  |
| ------------- | ---------------------------------------------------------------------------- |
| `build: .`    | Builds the Docker image using the `Dockerfile` in the current directory.     |
| `ports`       | Maps `${APP_PORT}` on your machine to port `80` inside the container.        |
| `volumes`     | Mounts your local project files into the container for live development.     |
| `depends_on`  | Ensures the database service (`db`) is healthy before starting `web`.        |
| `environment` | Passes DB connection credentials to the PHP application using `.env` values. |

---

#### 🔹 `db` Service (MariaDB)

| Key           | Description                                           |
| ------------- | ----------------------------------------------------- |
| `image`       | Uses the official MariaDB 10.6 image from Docker Hub. |
| `environment` | Sets initial DB credentials from the `.env` file.     |
| `volumes`     |                                                       |

* Persists DB data with a named volume (`db_data`).
* Initializes the database with the SQL script `elearn.sql`. |
  \| `healthcheck` | Checks if the DB server is ready using `mariadb-admin ping`. |
  \| `ports` | Maps `${DB_PORT}` on your host to port `3306` inside the container. |

---

#### 🔹 `volumes`

| Name      | Purpose                                                            |
| --------- | ------------------------------------------------------------------ |
| `db_data` | A named volume to persist database data across container restarts. |

---


## 🏁 Run the App

In the same directory:

```bash
docker compose up --build -d
```

Visit: **[http://localhost:8899](http://localhost:8899)**

---

## 🛑 Stop and Clean

* **To stop your application (and keep the database data):**
    ```bash
    docker compose down
    ```
    This will stop and remove the `web` and `db` containers, but the `db_data` volume will remain, so your database content will be preserved for the next time you start.

* **To start your application again (after stopping it):**
    ```bash
    docker compose up -d
    ```
    This will bring your containers back up, using the existing images and data.

* **To stop your application and remove all associated data (a complete fresh start):**
    ```bash
    docker compose down -v
    ```
    The `-v` flag tells Docker Compose to also remove any named volumes, including `db_data`. Use this if you want to completely reset your database to the state defined in `init.sql`.

* **To check the status of your running containers:**
    ```bash
    docker compose ps
    ```
---