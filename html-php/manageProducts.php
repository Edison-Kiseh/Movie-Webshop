<?php
    session_start();
    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Administrator page</title>
        <link href="../css/reset.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/manageProduct.css" rel="stylesheet"/>
        <link href="../css/header.css" rel="stylesheet" />
    </head>

    <body style="background-color: #041d2f;">
        <div class="container-trui">
            <?php include("./header.php");?>

            <h1>Manage products</h1>

            <?php
                if(isset($_GET['message'])){
                    echo("<div class=\"displayText\">");//Text to display depending on the user action
                        if($_GET['message'] == "removed"){
                            echo("<h4>The product has been removed</h4>");
                        }
                        else if($_GET['message'] == "added"){
                            echo("<h4>The product has been added</h4>");
                        }
                        else if($_GET['message'] == "updated"){
                            echo("<h4>The product has been modified successfully</h4>");
                        }
                    echo("</div>");
                }
            ?>
            
            <div class="container" id="content">
                <?php
                    $product_query = "SELECT productID, productName, price, parentalGuidance, rating, duration, releaseDate, removeProduct FROM products" or die("Could not fetch the data from the database");
                    $product_result = mysqli_query($link, $product_query) or die("There was an error executing the query");

                    $product_row = array();
                ?>
                <table>
                    <th class="product">Movie name</th><th>Price</th><th>PG</th><th>rating</th><th>duration</th><th>Release date</th>
                    <?php
                        while($product_row = mysqli_fetch_array($product_result)){
                            if(htmlspecialchars($product_row['removeProduct']) != "yes"){
                                echo("<tr>");
                                    echo("<td>" . htmlspecialchars($product_row['productName']) . "</td>");
                                    echo("<td>" . htmlspecialchars($product_row['price']) . "$</td>");
                                    echo("<td>" . htmlspecialchars($product_row['parentalGuidance']) . "</td>");
                                    echo("<td>" . htmlspecialchars($product_row['rating']) . "</td>");
                                    echo("<td>" . htmlspecialchars($product_row['duration']) . "</td>");
                                    echo("<td>" . htmlspecialchars($product_row['releaseDate']) . "</td>");
                                    echo("<td><a href=\"./productActions.php?pid=" . $product_row['productID'] . "&productAction=removeProduct\"><button>Remove</button></a></td>");
                                    echo("<td><a href=\"./productActions.php?pid=" . $product_row['productID'] . "&productAction=modifyProduct\"><button>Modify</button></a></td>");
                                echo("</tr>");
                            }
                        } 
                    ?>
                </table>
                <hr/>
                <?php
                    echo("<a href=\"./productActions.php?productAction=addProduct\"><button class=\"addProduct\">Add product</button></a>");
                    mysqli_close($link);
                ?>
            </div>
        </div>
    </body>
</html>