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
        <title>Order confirmation</title>
        <link href="../css/reset.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/updateProduct.css" rel="stylesheet"/>

        <script>
            function check()//To make sure that the form has been filled
            {
                var name = document.getElementById('name').value;
                var price = document.getElementById('price').value;
                var release = document.getElementById('release').value;
                var rating = document.getElementById('rating').value;
                var duration = document.getElementById('duration').value;

                if(name == "" || price == "" || release == "" || rating == "" || duration == "")
                {
                    if(name == "")
                    {
                        document.getElementById("name").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("name").placeholder = ""
                    }

                    if(price == "")
                    {
                        document.getElementById("price").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("price").placeholder = ""
                    }
                    
                    if(release == "")
                    {
                        document.getElementById("release").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("release").placeholder = ""
                    }

                    if(rating == "")
                    {
                        document.getElementById("rating").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("rating").placeholder = ""
                    }

                    if(duration == "")
                    {
                        document.getElementById("duration").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("duration").placeholder = ""
                    }

                return false;
                }

                return true;

            }
            </script>
    </head>

    <body class="body">
        <?php
            if(isset($_GET['pid'])){
                $id = $_GET['pid'];
                $pro_query = "SELECT * FROM products WHERE productID = '$id'" or die("Error fetching the data");
                $pro_result = mysqli_query($link, $pro_query) or die("Could not execute the query");
                $pro_details = mysqli_fetch_array($pro_result);

                echo("<h3>Input the new data you want to add to the fields</h3>");

                $movieName = htmlspecialchars($pro_details['productName']);
                $price = htmlspecialchars($pro_details['price']);
                $pg = htmlspecialchars($pro_details['parentalGuidance']);
                $rating = htmlspecialchars($pro_details['rating']);
                $duration = htmlspecialchars($pro_details['duration']);
                $release = htmlspecialchars($pro_details['releaseDate']);
    
                echo("<form action=\"" . $_SERVER['PHP_SELF'] . "?update=yes\" method=\"post\" onsubmit=\"return check()\">");
                    echo("<div class=\"container\">");
                        echo("<div class=\"current-product\">");
                            echo("<h4>Current product info</h4><hr/>");
                            echo("<p><b>Product name:</b> " . $movieName . "</p>");
                            echo("<p><b>Price: </b>" . $price . "</p>");
                            echo("<p><b>PG:</b> $rating</p>");
                            echo("<p><b>PG:</b> $duration</p>");
                            echo("<p><b>Release:</b> $release</p>");
                        echo("</div>");
    
                        echo("<div>");
                            echo("<h4>New information</h4><hr/>");
                            echo("<span>New name: *</span>");
                            echo("<input type=\"text\" name=\"name\" id=\"name\"/><br/><br/>");
                            echo("<span>New price: *</span>");
                            echo("<input type=\"text\" name=\"price\" id=\"price\"/><br/><br/>");
                            echo("<span>New rating: *</span>");
                            echo("<input type=\"text\" name=\"rating\" id=\"rating\"/><br/><br/>");
                            echo("<span>New duration: *</span>");
                            echo("<input type=\"text\" name=\"duration\" id=\"duration\"/><br/><br/>");
                            echo("<span>New release date: *</span>");
                            echo("<input type=\"text\" name=\"release\" id=\"release\"/><br/><br/>");
                        echo("</div>");
                    echo("</div>");
                    echo("<input type=\"submit\" name=\"submit\" class=\"button\">");
                echo("</div>");
    
                if(isset($_GET['update'])){
                    $new_name = htmlspecialchars($_POST['name']);
                    $new_price = htmlspecialchars($_POST['price']);
                    $new_rating = htmlspecialchars($_POST['rating']);
                    $new_duration = htmlspecialchars($_POST['duration']);
                    $new_release = htmlspecialchars($_POST['release']);
                    $new_pg = htmlspecialchars($_POST['parentalGuidance']);
    
                    $update_query = "UPDATE products SET productName='$new_name', price='$new_price', rating='$new_rating', duration='$new_duration', releaseDate='$new_release', parentalGuidance='$new_pg' WHERE productID = '$id'" or die("Could not update table");
                    $update_result = mysqli_query($link, $update_query) or die("Error executing the query");
    
                    header("Location: ./manageProducts?message=updated");
                }
            }
            else{
                header("Location: ./home.php");
            }

            mysqli_close($link);
        ?>
    </body>
</html>