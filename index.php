<?php
// Run the app: php -S localhost:8000
//$con = mysqli_connect("localhost", "devops", "123devops", "elearn");
?>
<?php
// Retrieve database connection details from environment variables
$db_host = getenv('MYSQL_HOST') ?: 'db'; // 'db' is the service name in docker-compose.yml
$db_user = getenv('MYSQL_USER') ?: 'devops';
$db_pass = getenv('MYSQL_PASSWORD') ?: '123devops';
$db_name = getenv('MYSQL_DATABASE') ?: 'elearn';

// Establish the database connection
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Medical Health : JKS </title>
    <style>
       .containerfaq{padding:2em 8rem;max-width:75%;margin:0 auto}.dictionary .dictionary-item{border-bottom:4px solid #929292}.dictionary .dictionary-item button[aria-expanded="true"]{border-bottom:4px solid #1c0ef2}.dictionary button{position:relative;display:block;text-align:left;width:100%;color:#333;font-size:1.15rem;font-weight:600;border:none;background:none;outline:none}.dictionary button:hover,.dictionary button:focus{cursor:pointer;color:#1c0ef2!important}.dictionary button:hover::after,.dictionary button:focus::after{cursor:pointer;color:#1c0ef2!important;border:1px solid #1c0ef2!important}.dictionary button .WTitle{padding:1em 1.5em 0 0;line-height:22px}.dictionary button .iconplus{display:inline-block;position:absolute;top:22px;right:0;width:22px;height:22px;border:1px solid;border-radius:22px}.dictionary button .iconplus::before{display:block;position:absolute;content:"";top:9px;left:5px;width:10px;height:2px;background:currentColor}.dictionary button .iconplus::after{display:block;position:absolute;content:"";top:5px;left:9px;width:2px;height:10px;background:currentColor}.dictionary button[aria-expanded="true"]{color:#1c0ef2}.dictionary button[aria-expanded="true"] .iconplus::after{width:0}.dictionary button[aria-expanded="true"]+.WDescription{opacity:1;max-height:max-content;transition:all 200ms linear;will-change:opacity,max-height}.dictionary .WDescription{opacity:0;max-height:0;overflow:hidden;transition:opacity 200ms linear,max-height 200ms linear;will-change:opacity,max-height}.dictionary .WDescription h1{font-size:1.5rem;font-weight:500;margin:1em 0;padding-left:45px;padding-right:45px;line-height:28px}.title>.bandage{display:inline-block;width:38px;height:30px;-webkit-border-radius:50%!important;-moz-border-radius:50%!important;border-radius:50%!important;text-align:center;padding-top:0;padding-left:1px;font-size:15px;margin-right:12px;border:1px solid #333}h1,h2{font-size:20px}@media (max-width:500px){.containerfaq{padding:2em 1rem;max-width:1300px}h1,h2{font-size:18px}.dictionary button{font-size:16px!important}.dictionary .WDescription p{font-size:16px!important}.it-tabs{margin-top:5px!important}}#search-bar{width:98%;color:#302f2f;font-weight:800;font-size:22px;border:2px solid #ccc;border-radius:5px;margin-bottom:44px}#search-bar:hover,#search-bar:focus{border:2px solid red}#search-bar{height:40px}#search-bar::placeholder{padding-left:50px}a,.btn{-webkit-transition:all 0.5s ease-out 0s;-moz-transition:all 0.5s ease-out 0s;-ms-transition:all 0.5s ease-out 0s;-o-transition:all 0.5s ease-out 0s;transition:all 0.5s ease-out 0s}a,button,input,btn{outline:medium none}a{color:var(--iq-body-text);text-decoration:none}h1,h2,h3,h4,h5,h6{font-weight:400;margin:0em;line-height:1.2;color:var(--iq-white)}h1,.h1{font-size:3.052em}.container-fluid{padding:0 4em}h1{font-size:3em}p{line-height:1.66em}.navbar{display:flex;align-items:center}header#main-header{position:fixed;left:0em;right:0em;text-align:center;z-index:10000003;background:rgb(20 20 20 / .8)!important}li.menu-item.active a{color:var(--iq-primary)}header .navbar-light .navbar-brand img.logo{width:8em;color:red;font-size:1.4em;font-weight:700}header .navbar ul li{list-style:none;margin-right:1.125em;position:relative;transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out;-moz-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;display:inline-block}header .navbar ul li:last-child{margin-right:0}header#main-header{position:fixed;left:0em;top:0;right:0em;text-align:center;background:#242424!important;-webkit-backdrop-filter:blur(.625em);backdrop-filter:blur(15.625em)}.navbar ul li:last-child{margin-right:0}.navbar ul li{list-style:none;margin-right:1.125em;position:relative;transition:all 0.3s ease-in-out;-moz-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;display:inline-block}#scrollup{position:fixed;margin:0em;color:#3c2424;bottom:1em;cursor:pointer;right:1.563em;height:45px;width:42px;font-weight:1000;text-align:center;font-size:40px}#scrollup:hover{opacity:1;color:red}.list-inline{padding-left:0;list-style:none}img{max-width:100%;height:auto}::-webkit-scrollbar{width:.25em}::-webkit-scrollbar-thumb{background:#292929}div#my-video{height:85vh}button.vjs-big-play-button.border-0{width:2.3em;height:1.5em}.headertoop{position:fixed;top:0;width:100%;background-color:#292929;z-index:2147483648;left:0}.progress-bar{height:5px;background:red;width:0%}a{cursor:pointer}.show{display:block}.pagination{margin-top:10px;text-align:center;padding:10px;font-size:16px}.pagination a,.pagination span{display:inline-block;background-color:#f2f2f2;border:1px solid #ddd;display:inline-block;padding:5px 10px;margin:0 5px;color:#333;text-decoration:none;border-radius:5px;font-size:16px}.pagination a:hover{background-color:#bd7878;color:#fff}.pagination .current{background-color:#27408b;color:#fff;margin:0 5px;padding:5px 10px;border-radius:5px;font-size:16px}.pagination-dots{padding:5px 10px;margin-right:5px}
    </style>
</head>

<body style="font-family: Times New Roman; background-color: #c6cbccc7 !important;">
    <!-- ----------------scroll indicator------------ -->
    <div title="Scroll Indicator" class="headertoop">
        <div class="progress-bar" id="myBar"></div>
    </div>
    <!-- -------------end------------ -->
    <!-- Header -->
    <header id="main-header">
        <nav class="navbar">
            <a style="font-size: 3em;font-weight: 900;color: #b5b3b3;padding: 0 0 0 3em;" href="./index.php"> Medical Health - By Janak Shrestha </a>
        </nav>
    </header>
    <!-- Header End -->
    <main style="padding-top: 80px;">
    <center>
        <h1><b style="color: rgb(73 71 71); text-transform: capitalize; font-size:30px">Medical Health Dictionary : <?= "<b>" . mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM words_collection"))["total"] . " words</b>"; ?> </b></h1>
    </center>
    <div class="containerfaq">
        <input type="text" id="search-bar" placeholder="Search here..." />
        <?php

        // Sanitize and set the sorting column
        $sort = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'title';

        // Sanitize and set the sorting order
        $order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';

        // Set the number of records to display per page
        $records_per_page = 50;

        // Get the current page number from the query string
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Calculate the offset for the SQL query
        $offset = ($current_page - 1) * $records_per_page;

        // Generate the sorting links/buttons
        echo '<div style="padding-bottom: 20px; text-align: center;">';
        echo '<p style="font-size: 20px; border: 2px solid green; display: inline-block; border-radius: 8px; padding: 10px; margin: 0;">';
        echo 'Sort by:';
        echo '<a style="padding: 10px;" href="?sort=title&order=desc&page=' . $current_page . '">Name(&uarr;)</a>|';
        echo '<a style="padding: 10px;" href="?sort=title&order=asc&page=' . $current_page . '">Name(&darr;)</a>';
        echo '</p>';
        echo '</div>';

        echo '<style>@media (max-width: 768px) { p { font-size: 16px; } a { display: block; padding: 5px; } }</style>';

        // Build the SQL query using the selected sorting method and order
        $sql = "SELECT * FROM words_collection ORDER BY $sort $order LIMIT $offset, $records_per_page";

        // Execute the SQL query
        $result = mysqli_query($con, $sql);

        // Calculate total pages for pagination
        $sql_total = "SELECT COUNT(*) AS count FROM words_collection";
        $result_total = mysqli_query($con, $sql_total);
        $row_total = mysqli_fetch_assoc($result_total);
        $total_records = $row_total["count"];
        $total_pages = ceil($total_records / $records_per_page);

        // --- Start of Pagination HTML Function ---
        function generatePaginationHtml($currentPage, $totalPages, $sort, $order, $self) {
            $pagination_html = '<div class="pagination">';
            if ($currentPage > 1) {
                $pagination_html .= '<a href="' . $self . '?sort=' . $sort . '&order=' . $order . '&page=' . ($currentPage - 1) . '">&laquo; Prev</a>';
            }

            $start_page = max(1, $currentPage - 2);
            $end_page = min($start_page + 5, $totalPages);

            if ($start_page > 1) {
                $pagination_html .= '<a href="' . $self . '?sort=' . $sort . '&order=' . $order . '&page=1" class="pagination-link">1</a>';
                if ($start_page > 3) {
                    $pagination_html .= '<span class="pagination-dots">&hellip;</span>';
                }
            }

            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $currentPage) {
                    $pagination_html .= '<span class="current">' . $i . '</span>';
                } else {
                    $pagination_html .= '<a href="' . $self . '?sort=' . $sort . '&order=' . $order . '&page=' . $i . '" class="pagination-link">' . $i . '</a>';
                }
            }

            if ($end_page < $totalPages) {
                if ($end_page < $totalPages - 1) {
                    $pagination_html .= '<span class="pagination-dots">&hellip;</span>';
                }
                $pagination_html .= '<a href="' . $self . '?sort=' . $sort . '&order=' . $order . '&page=' . $totalPages . '" class="pagination-link">' . $totalPages . '</a>';
            }

            if ($currentPage < $totalPages) {
                $pagination_html .= '<a href="' . $self . '?sort=' . $sort . '&order=' . $order . '&page=' . ($currentPage + 1) . '">Next &raquo;</a>';
            }
            $pagination_html .= '</div>';
            return $pagination_html;
        }
        // --- End of Pagination HTML Function ---

        // Display pagination at the TOP
        echo generatePaginationHtml($current_page, $total_pages, $sort, $order, $_SERVER["PHP_SELF"]);

        // Initialize the $index variable
        $index = ($current_page - 1) * $records_per_page + 1;

        // Output HTML elements dynamically based on data
        echo '<div class="dictionary">';
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the item with the unique id
            $html = '<div class="dictionary-item" id="title-' . $row["id"] . '">';
            $html .= '<button aria-expanded="false">';
            $html .= '<p class="title" >';
            $html .= '<span class="bandage">' . $index . '</span>' . $row["title"];
            $html .= '</p>';
            $html .= '<span class="iconplus"></span>';
            $html .= '</button>';
            $html .= '<div class="WDescription">';
            $html .= '<h1>' . $row["description"];
            $html .= '</div>';
            $html .= '</div>';

            echo $html;

            // Increment the index after each iteration
            $index++;
        }

        echo '</div>';

        // Display pagination at the BOTTOM
        echo generatePaginationHtml($current_page, $total_pages, $sort, $order, $_SERVER["PHP_SELF"]);

        echo '</div>';
        ?>
    </div>
    </main>

    <!-- ------------------- scroll up btn -----------------  -->
    <div id="scrollup" title="Go to top" onclick="document.documentElement.scrollTop = 0;">&xutri;</div>
    <!-- ------------ end -------------  -->
    <script>
       window.onscroll=(e)=>{let winScroll=document.body.scrollTop||document.documentElement.scrollTop;let height=document.documentElement.scrollHeight-document.documentElement.clientHeight;let scrolled=(winScroll/height)*100;document.getElementById("myBar").style.width=scrolled+"%";(document.body.scrollTop>400||document.documentElement.scrollTop>400)?document.getElementById("scrollup").style.display="block":document.getElementById("scrollup").style.display="none";if(prevScrollpos>window.pageYOffset){document.getElementById("main-header").style.display="block"}else{document.getElementById("main-header").style.display="none"}
		prevScrollpos=window.pageYOffset}
		let prevScrollpos=window.pageYOffset;const items=document.querySelectorAll('.dictionary button');function toggledictionary(){const itemToggle=this.getAttribute('aria-expanded');for(i=0;i<items.length;i++){items[i].setAttribute('aria-expanded','false')}
		if(itemToggle=='false'){this.setAttribute('aria-expanded','true')}}
		items.forEach(item=>item.addEventListener('click',toggledictionary));const searchBar=document.getElementById('search-bar');searchBar.addEventListener('input',searchDictionary);function searchDictionary(){const query=searchBar.value.toLowerCase();const dictionaryItems=document.querySelectorAll('.dictionary-item');dictionaryItems.forEach(item=>{const title=item.querySelector('.title').textContent.toLowerCase();if(title.includes(query)){item.style.display='block'}else{item.style.display='none'}})}
    </script>
</body>

</html>
