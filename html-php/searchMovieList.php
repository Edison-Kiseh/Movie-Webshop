<?php
    session_start();
    include_once "logging/ErrorHandling.php";
    include_once "logging/ExceptionHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $mysqli = new mysqli($host, $user, $password, $database) or die("Error establishing connection to database");
	
    $searchName = isset($_POST['search']) ? $_POST['search'] : '';//AJAx request to get movie name

    $pattern = '/[!@#$%^&*(),.?":{}|<>]/';

    try{
        //match the search pattern with the special chars and then throw exception if the match
        if(preg_match($pattern, $searchName)){
            throw new MyException("<h2 style=\"text-align: center; color: white;\">Error: use of special characters in the search field</h2>");
        }
    }

    catch(MyException $e){
        $e->HandleException();
    }

    catch(Exception $e){
        $e->getMessage();
    }

    if ($searchName == 'all') {//selecting movies from the db based on my genres
        $query = "SELECT productName, image, price, removeProduct FROM products";
    } else {
        $query = "SELECT productName, image, price, removeProduct FROM products WHERE productName LIKE ?";
    }
    
    $stmt = $mysqli->prepare($query);//prepare the query
    $searchName = "%$searchName%";
    if ($searchName != '') {
        $stmt->bind_param("s", $searchName);
    }

    $stmt->execute();//execute the query

    $stmt->bind_result($name, $image, $price, $remove);
    $stmt->store_result();

    $num_row = $stmt->num_rows;//number of rows

    if($num_row != 0){
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
    }
    else{
        echo("<h1 style=\"text-align: center; color: white\">Product not found</h1>");
    }

    mysqli_close($mysqli);
?>


