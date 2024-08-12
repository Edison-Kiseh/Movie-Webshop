<?php
    session_start();
    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $mysqli = new mysqli($host, $user, $password, $database) or die("Error establishing connection to database");
	
    $selectedGenre = isset($_POST['genre']) ? $_POST['genre'] : 'all';//AJAx request to get genre

    if ($selectedGenre == 'all') {//selecting movies from the db based on my genres
        $query = "SELECT productName, image, price, removeProduct FROM products";
    } else {
        $query = "SELECT productName, image, price, removeProduct FROM products LEFT JOIN productCategory ON products.productID = productCategory.productID LEFT JOIN category ON category.categoryID = productCategory.categoryID WHERE categoryName = ?";
    }

    $stmt = $mysqli->prepare($query);//prepare the query
    if ($selectedGenre != 'all') {
        $stmt->bind_param("s", $selectedGenre);
    }

    $stmt->execute();//execute the query

    $stmt->bind_result($name, $image, $price, $remove);
    $stmt->store_result();

    $num_row = $stmt->num_rows;//number of rows

    for ($counter = 1; $counter <= $num_row; $counter++) {
        $stmt->fetch();
    
        if ($counter % 6 == 1) {
            if ($counter > 1) {
                echo("</div>");
            }
            echo("<div class=\"container content\">");
        }
    
        if($remove == 'no'){//fetching only for those products that have not been removed from the database by an admin
            echo("<a href=\"./movieInfo/movieInfo.php?name=$name\">");
            echo("<div class=\"card\" col=\"2\">");
            echo("<img src=\"$image\" alt=\"movies\" class=\"movie-image\"/>");
            echo("<div class=\"image-info\">");
            echo("<p>$name</p>");
            echo("<p><b>$price" . "$</b></p>");
            echo("</div></div></a>");
        }
    }
    
    if ($counter > 1 && $counter % 6 != 1) {
        echo("</div>");
    }

    mysqli_close($mysqli);
?>


