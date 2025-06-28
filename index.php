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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
    <title>Medical Health : JKS </title>
    <style>
    *{box-sizing:border-box}body{font-family:Times New Roman,serif;background-color:#c6cbccc7!important;margin:0;padding:0;line-height:1.6}.containerfaq{padding:2em 1rem;max-width:100%;margin:0 auto}@media (min-width:576px){.containerfaq{padding:2em 2rem;max-width:540px}}@media (min-width:768px){.containerfaq{padding:2em 4rem;max-width:720px}}@media (min-width:992px){.containerfaq{padding:2em 6rem;max-width:960px}}@media (min-width:1200px){.containerfaq{padding:2em 8rem;max-width:1140px}}.dictionary .dictionary-item{border-bottom:4px solid #929292}.dictionary .dictionary-item button[aria-expanded=true]{border-bottom:4px solid #1c0ef2}.dictionary button{position:relative;display:block;text-align:left;width:100%;color:#333;font-size:1.15rem;font-weight:600;border:none;background:0 0;outline:0;padding:1em 0}.dictionary button:focus,.dictionary button:hover{cursor:pointer;color:#1c0ef2!important}.dictionary button:focus::after,.dictionary button:hover::after{cursor:pointer;color:#1c0ef2!important;border:1px solid #1c0ef2!important}.dictionary button .WTitle{padding:0 1.5em 0 0;line-height:22px}.dictionary button .iconplus{display:inline-block;position:absolute;top:50%;right:0;transform:translateY(-50%);width:22px;height:22px;border:1px solid;border-radius:22px}.dictionary button .iconplus::before{display:block;position:absolute;content:"";top:9px;left:5px;width:10px;height:2px;background:currentColor}.dictionary button .iconplus::after{display:block;position:absolute;content:"";top:5px;left:9px;width:2px;height:10px;background:currentColor}.dictionary button[aria-expanded=true],.sorting-container a:hover{color:#1c0ef2}.dictionary button[aria-expanded=true] .iconplus::after{width:0}.dictionary button[aria-expanded=true]+.WDescription{opacity:1;max-height:max-content;transition:.2s linear;will-change:opacity,max-height}.dictionary .WDescription{opacity:0;max-height:0;overflow:hidden;transition:opacity .2s linear,max-height .2s linear;will-change:opacity,max-height;padding:0 1em}.dictionary .WDescription h1{font-size:1.5rem;font-weight:500;margin:1em 0;line-height:1.5}.title>.bandage{display:inline-block;width:38px;height:30px;border-radius:50%!important;text-align:center;padding-top:.3em;font-size:15px;margin-right:12px;border:1px solid #333}h1,h2{font-size:20px}#search-bar{width:100%;color:#302f2f;font-weight:800;font-size:18px;border:2px solid #ccc;border-radius:5px;margin-bottom:2em;padding:.5em 1em .5em 3em;background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>');background-repeat:no-repeat;background-position:1em center;background-size:1.5em;height:50px}#search-bar:focus,#search-bar:hover{border:2px solid red}header#main-header{position:fixed;left:0;right:0;top:0;text-align:center;z-index:10000003;background:rgb(20 20 20 / .8)!important;-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);padding:.5em 1em}.navbar{display:flex;align-items:center;justify-content:center;width:100%}.navbar a{font-size:1.5em;font-weight:900;color:#b5b3b3;padding:0;text-decoration:none;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%}@media (min-width:768px){.navbar a{font-size:2em}}@media (min-width:992px){.navbar a{font-size:3em;padding:0 0 0 1em}}main{padding-top:70px}@media (min-width:768px){main{padding-top:80px}}.headertoop{position:fixed;top:0;width:100%;background-color:#292929;z-index:2147483648;left:0}.progress-bar{height:5px;background:red;width:0%}#scrollup{position:fixed;margin:0;color:#3c2424;bottom:1em;cursor:pointer;right:1em;height:45px;width:42px;font-weight:1000;text-align:center;font-size:40px;display:none;background:rgba(255,255,255,0);border-radius:50%;line-height:45px}#scrollup:hover{opacity:1;color:red}.pagination{margin:1em 0;text-align:center;padding:10px;font-size:16px}.pagination a,.pagination span{display:inline-block;background-color:#f2f2f2;border:1px solid #ddd;padding:5px 10px;margin:0 2px;color:#333;text-decoration:none;border-radius:5px;font-size:16px}.pagination a:hover{background-color:#bd7878;color:#fff}.pagination .current{background-color:#27408b;color:#fff;margin:0 2px;padding:5px 10px;border-radius:5px;font-size:16px}.pagination-dots{padding:5px 10px;margin-right:5px}.sorting-container{padding-bottom:20px;text-align:center;margin:1em 0}.sorting-container p{font-size:18px;border:2px solid green;display:inline-block;border-radius:8px;padding:10px;margin:0}.sorting-container a{padding:0 5px;color:#333;text-decoration:none}@media (max-width:768px){.sorting-container p{font-size:16px;padding:8px}.sorting-container a{display:inline-block;padding:5px}h1,h2{font-size:18px}.dictionary .WDescription p,.dictionary button{font-size:16px!important}}@media (max-width:576px){.dictionary button{font-size:1rem!important;padding:.8em 0}.dictionary .WDescription h1{font-size:1.1rem;margin:.8em 0}.title>.bandage{width:30px;height:24px;font-size:13px;padding-top:.2em;margin-right:8px}}       
    </style>
</head>

<body>
    <!-- ----------------scroll indicator------------ -->
    <div title="Scroll Indicator" class="headertoop">
        <div class="progress-bar" id="myBar"></div>
    </div>
    <!-- -------------end------------ -->
    <!-- Header -->
    <header id="main-header">
        <nav class="navbar">
            <a href="./index.php">Medical Health - Dr. Janak</a>
        </nav>
    </header>
    <!-- Header End -->
    <main>
        <div style="text-align: center;">
            <h1><b style="color: rgb(73 71 71); text-transform: capitalize; font-size: 1.5em">Medical Health Dictionary : <?= "<b>" . mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM words_collection"))["total"] . " words</b>"; ?> </b></h1>
        </div>
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
            echo '<div class="sorting-container">';
            echo '<p>';
            echo 'Sort by:';
            echo '<a href="?sort=title&order=desc&page=' . $current_page . '">Name(&uarr;)</a>|';
            echo '<a href="?sort=title&order=asc&page=' . $current_page . '">Name(&darr;)</a>';
            echo '</p>';
            echo '</div>';

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
      window.onscroll=function(e){let t=document.body.scrollTop||document.documentElement.scrollTop,l=document.documentElement.scrollHeight-document.documentElement.clientHeight;document.getElementById("myBar").style.width=t/l*100+"%",document.body.scrollTop>400||document.documentElement.scrollTop>400?document.getElementById("scrollup").style.display="block":document.getElementById("scrollup").style.display="none",prevScrollpos>window.pageYOffset?document.getElementById("main-header").style.display="block":document.getElementById("main-header").style.display="none",prevScrollpos=window.pageYOffset};let prevScrollpos=window.pageYOffset;const items=document.querySelectorAll(".dictionary button");function toggleDictionary(){let e=this.getAttribute("aria-expanded");for(let t=0;t<items.length;t++)items[t].setAttribute("aria-expanded","false");"false"==e&&this.setAttribute("aria-expanded","true")}items.forEach(e=>e.addEventListener("click",toggleDictionary));const searchBar=document.getElementById("search-bar");function searchDictionary(){let e=searchBar.value.toLowerCase(),t=document.querySelectorAll(".dictionary-item");t.forEach(t=>{let l=t.querySelector(".title").textContent.toLowerCase();l.includes(e)?t.style.display="block":t.style.display="none"})}searchBar.addEventListener("input",searchDictionary);
    </script>
</body>

</html>