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
        <title>Shopping cart</title>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/header.css" rel="stylesheet"/>
        <link href="../css/shoppingCart.css" rel="stylesheet"/>  

        <script>
            function check()//To make sure that the form has been filled
            {
                var street = document.getElementById('sname').value;
                var number = document.getElementById('number').value;
                var municipality = document.getElementById('municipality').value;
                var zip = document.getElementById('zip').value;

                if(street == "" || number == "" || municipality == "" || zip == "")
                {
                    if(street == "")
                    {
                        document.getElementById("sname").placeholder = "This field is required!"
                    }

                    if(number == "")
                    {
                        document.getElementById("number").placeholder = "This field is required!"
                    }

                    if(municipality == "")
                    {
                        document.getElementById("municipality").placeholder = "This field is required!"
                    }

                    if(zip == "")
                    {
                        document.getElementById("zip").placeholder = "This field is required!"
                    }

                return false;
                }

                return true;
            }
        </script>
    </head>

    <body style="background-color: #041d2f;">
        <?php include("./header.php");?>

        <div class="container-trui"> 
            <h1>Cart</h1>
            <div class="container" id="child-container">
            <?php
                $userID = $_SESSION['id'];

                if(!$userID){//redirect to home is no session id was found
                    header("Location: ./home.php");
                }

                $fetch_query = "SELECT * FROM cartProducts LEFT JOIN cart ON cart.cartID = cartProducts.cartID LEFT JOIN products ON products.productID = cartProducts.productID WHERE cart.customerID = '$userID' AND cartProducts.paymentStatus = 'not paid' " or die("Error fetchingt the data");
                $fetch_result = mysqli_query($link, $fetch_query) or die("Error executing query");
                $num_rows = mysqli_num_rows($fetch_result);

                if($num_rows > 0){
                    echo("<table>");
                    echo("<th>Movie</th><th>Name</th><th>Price</th><th colspan=\"3\">Quantity");
                        while($row = mysqli_fetch_array($fetch_result)){
                            $image = htmlspecialchars($row['image']);
                            $name = htmlspecialchars($row['productName']);
                            $price = htmlspecialchars($row['total']);
                            $quantity = htmlspecialchars($row['quantity']);
                            $paid = htmlspecialchars($row['paymentStatus']);
                            
                            echo("<tr>");
                                echo("<td><img src=\"" . $image . "\" class=\"cartImage\"/></td>");
                                echo("<td>" . $name . "</td>");
                                echo("<td>" . $price . "$</td>");
                                echo("<td class=\"sign\"><a href=\"./addToCart.php?stock=minus&name=". $name . "\"><button class=\"operand\">-</button></a></td>");
                                echo("<td class=\"quantity\">" . $quantity . "</td>");
                                echo("<td class=\"sign\"><a href=\"./addToCart.php?stock=plus&name=". $name . "\"><button class=\"operand\">+</button></a></td>");
                            echo("</tr>");
                        }
                    echo("</table>");  
                ?>
            </div>

            <?php 
                $query = "SELECT SUM(total) AS total FROM cartProducts LEFT JOIN cart ON cartProducts.cartID = cart.cartID WHERE customerID = '$userID' AND cartProducts.paymentStatus = 'not paid'" or die("Could not fetch data");
                $result = mysqli_query($link, $query);
                $total = mysqli_fetch_array($result);
                
                echo("<span class=\"total\">Total: " . $total['total'] . "$</span>");
                $_SESSION['total'] = $total['total'];

                mysqli_close($link);
                echo("<a href=\"" . $_SERVER['PHP_SELF'] . "?details=true#info\"><button class=\"checkout\">Checkout</button></a>");

                } 

                else{
                    echo("<h2>Looks like your cart is currently empty...</h2>");
                }

            ?>

            <?php
                if(isset($_GET['details'])){
                    echo("<div class=\"container\" id=\"info\">
                        <h1>Shipping address</h1>

                        <form action=\"./confirmOrder.php\" method=\"post\" onsubmit=\"return check()\">
                            <p>
                                <label for=\"sname\" >Street name</label>
                                <span>&#42;</span><br />
                                <input type=\"text\" id=\"sname\" name=\"street\" class=\"input-field\" placeholder=\"Your street name\"/>
                            </p>
        
                            <p>
                                <label for=\"number\">Street number</label>
                                <span>&#42;</span><br />
                                <input type=\"text\" id=\"number\" name=\"number\" class=\"input-field\"  placeholder=\"Your street number\"/>
                            </p>
        
                            <p>
                                <label for=\"municipality\">Municipality</label>
                                <span>&#42;</span><br />
                                <input type=\"text\" id=\"municipality\" name=\"municipality\" class=\"input-field\"  placeholder=\"Municipality\"/>
                            </p>
        
                            <p>
                                <label for=\"zip\">Zip code</label>
                                <span>&#42;</span><br />
                                <input type=\"text\" id=\"zip\" name=\"zip\" class=\"input-field\"  placeholder=\"Zip code\"/>
                            </p>
                            
                            <input type=\"submit\" name=\"sendDetails\" class=\"button\" value=\"Submit\"/>
                        </form> 
                    </div>");
                }

            ?>
        </div>
    </body>
</html>