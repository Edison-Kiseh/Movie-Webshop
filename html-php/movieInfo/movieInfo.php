<?php 
    include('./connectDB.php');
    include_once "../logging/ErrorHandling.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Movie</title>
        <link href="../../css/reset.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../../css/header.css" rel="stylesheet"/>
        <link href="../../css/movieInfo.css" rel="stylesheet"/>
    </head>

    <body style="background-color: #030e16; color: white;">
        <?php include('./header.php');?><!--Header-->
 
            <?php
                $productName = $_GET['name'];

                $query = "SELECT * FROM Products WHERE productName = '$productName'" or die("Error executing the query");
                $result = mysqli_query($link, $query) or die("Could not execute the query");
                                    
                $row = mysqli_fetch_array($result);
                $id = htmlspecialchars($row['productID']);
                $movieImage = htmlspecialchars($row['image']);
                $parentalGuidance = htmlspecialchars($row['parentalGuidance']);
                $rating = htmlspecialchars($row['rating']);
                $duration = htmlspecialchars($row['duration']);
                $movieName = htmlspecialchars($row['productName']);
                $description = htmlspecialchars($row['description']);
                $releaseDate = htmlspecialchars($row['releaseDate']);
                $price = htmlspecialchars($row['price']);
                $actors = htmlspecialchars($row['actors']);
                $director = htmlspecialchars($row['director']);
                $landscapeImage = htmlspecialchars($row['landscapeImage']);
                $trailer = htmlspecialchars($row['trailer']);

                echo("<div class=\"picture\">
                    <img src=".$landscapeImage." alt=\"movie image\" class=\"galery\"/><br/>
                </div>");

                echo("<div class=\"contain\">");  

                echo("<div><img src=\"../" . $movieImage . "\" alt=\"movie image\" class=\"movie-image\"/><br/></div>");
            ?>
            <div class="details">
                <?php
                    $i = 0;
                    //Retrieving the category name of the product
                    $query2 = "SELECT categoryName FROM category LEFT JOIN productcategory ON category.categoryID = productcategory.categoryID 
                    LEFT JOIN products ON products.productID = productcategory.productID WHERE productName = '$productName'" or die("Error: there was an error fetching the image");
                    $result2 = mysqli_query($link, $query2) or die("Could not execute the query");
                                            
                    $row2 = array();//declaring a new array to store the product categories
                    $categories = "";

                    echo("<div class=\"mini-info\">");
                    echo("<div class=\"hd\"><b>HD</b></div>&nbsp;&nbsp;");
                    echo("<p class=\"pg\"><b>" . $parentalGuidance . "</b></p>&nbsp;&nbsp;");
                    echo("<img src=\"../../images/star.png\" alt=\"star\" class=\"star\"/>&nbsp;");
                    echo("<p>" . $rating . "</p>&nbsp;&nbsp;");
                    echo("<p>" . $duration. "</p>");
                    echo("</div>");
                    echo("<h2>". $movieName . "</h2>");
                    echo("<p class=\"movie-description\">". $description . "</p>");
                    echo("<span>Genre: ");
                        while($row2 = mysqli_fetch_array($result2)){//echo the genres
                            echo(htmlspecialchars($row2['categoryName']));
                            $categories .= "'".htmlspecialchars($row2['categoryName'])."', ";
                            echo(" / ");
                        } 
                    echo("</span>");
                    echo("<br/>");
                    echo("<span>Actors: " .  $actors . "</span><br/>");
                    echo("<span>Director: " . $director . "</span><br/>");
                    echo("<span>Release date: " . $releaseDate . "</span>");
                    
                    $categories = rtrim($categories, ", ");//to remove the trailing comma at the end of the string
                ?>
            </div>

            <div class="extra-details">
                <?php echo("<p class=\"amount\"><b>" . $price . "$</b></p>");

                    if(isset($_SESSION['id'])){
                        echo("<a href=\"../addToCart.php?id=$id&name=$movieName&price=$price&image=$movieImage\"><button class=\"button\">Add to cart</button></a>");
                    }
                    else{
                        echo("<a href=\"../login.php\" title=\"Add this item to your cart\"><button class=\"button\">Add to cart</button></a>");
                    }

                    echo(" <hr/>
                    <a href=".$trailer." target=\"_blank\" title=\"Click to watch movie trailer\"><button class=\"button\">Movie trailer</button></a>");
                ?>
                
            </div>
        </div>

        <h2 class="related-movies">Related movies</h2>

        <?php
        //query to select the movies related the above genres
            $query_related_movies = "SELECT * FROM products LEFT JOIN productcategory ON products.productID = productcategory.productID LEFT JOIN category ON category.categoryID = productcategory.categoryID WHERE categoryName IN ($categories) AND productName != '$movieName' GROUP BY products.productID" or die("Error executing the query");
            $related_result = mysqli_query($link, $query_related_movies) or die("Could not execute this query");

            $result_row = array();
            
            $counter = 0;

            while ($result_row = mysqli_fetch_array($related_result)) {
                $image = htmlspecialchars($result_row['image']);
                $name = htmlspecialchars($result_row['productName']);
                $price = htmlspecialchars($result_row['price']);
            
                if ($counter % 5 == 0) {
                    if ($counter > 0) {
                        echo("</div>");
                    }
                    echo("<div class=\"container\">");
                }
                if($result_row['removeProduct'] == 'no'){
                    echo("<a href=\"". $_SERVER['PHP_SELF'] ."?name=$name\">");
                    echo("<div class=\"card\" col=\"2\">");
                    echo("<img src=\"../" . $image . "\" alt=\"related movies\"/>");
                    echo("<div class=\"image-info\">");
                    echo("<p>$name</p>");
                    echo("<p><b>$price$</b></p>");
                    echo("</div></div></a>");
                }

                $counter++; 
            }
            
            if ($counter > 0 && $counter % 5 != 0) {
                echo("</div>");
            }

            mysqli_close($link);
        ?>
        <?php  echo("</div>"); include("./footer.html");?>
    </body>
</html>