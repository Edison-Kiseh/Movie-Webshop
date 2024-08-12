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
        <title>Orders</title>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/header.css" rel="stylesheet"/>
        <link href="../css/displayOrder.css" rel="stylesheet"/> 
        <script src="../js/jquery.js"></script>

        <script>
           $(document).ready(function(){
            $("#container-trui").css("filter", "blur(20px)");
                $("#message").hide();
                var i = 1;
                var interval;
                for(i = 1; i < 6; i++){
                    $("#dot" + i).hide();
                }
                setTimeout(function(){
                    $("#dot1").show();
                }, 1000);
                setTimeout(function(){
                    $("#dot2").show();
                }, 2000);
                setTimeout(function(){
                    $("#dot3").show();
                }, 3000);
                setTimeout(function(){
                    $("#dot4").show();
                }, 4000);
                setTimeout(function(){
                    $("#dot5").show();
                }, 5000);

                setTimeout(function(){
                    $(".wrapper").hide();
                    $("#message").show();
                    $("#message").click(function(){
                    $(this).hide();
                    $("#container-trui").css("filter", "blur(0px)");
                });
                }, 6000);
           });
       </script>
    </head>

    <body style="background-color: #041d2f;">
        <?php
            if(isset($_GET['order'])){
                echo("<div class=\"showMessage\" id=\"message\">");
                    echo("<h4>Your order has been placed successfully!</h4><br/>");
                    echo("<h5>Thank you for choosing tenflix</h5>");
                    echo("<p style=\"text-align: center\">Click anywhere to continue</p>");
                    echo("<div class=\"green-image\">");
                        echo("<img src=\"../images/check-green.gif\" alt=\"green checkmark\" class=\"check\"/>");
                    echo("</div>");
                echo("</div>");

                echo("
                <div class=\"wrapper\">
                    <div class=\"process\">
                        <h1>Processing</h1>
                    
                        <img src=\"../images/dot.png\" alt=\"dot\" id=\"dot1\" class=\"dotimage\"/>
                        <img src=\"../images/dot.png\" alt=\"dot\" id=\"dot2\" class=\"dotimage\"/>
                        <img src=\"../images/dot.png\" alt=\"dot\" id=\"dot3\" class=\"dotimage\"/>
                        <img src=\"../images/dot.png\" alt=\"dot\" id=\"dot4\" class=\"dotimage\"/>
                        <img src=\"../images/dot.png\" alt=\"dot\" id=\"dot5\" class=\"dotimage\"/>
                    </div>
                    
                    <p class=\"order\">Your order is being processed. This will take a few seconds</p>

                </div>");
            }
            else{
                header("Location: ./home.php");
            }
        ?>

        <div class="container-trui" id="container-trui"> 
            <h1>Your orders</h1>
            <div class="container" id="child-container">
                <?php
                    $userID = $_SESSION['id'];

                    if(!$userID){//redirect to home is no session id was found
                        header("Location: ./home.php");
                    }

                    if(isset($_GET['order'])){
                        $fetch_query = "SELECT * FROM cartProducts LEFT JOIN cart ON cart.cartID = cartProducts.cartID LEFT JOIN products ON products.productID = cartProducts.productID WHERE cart.customerID = '$userID' AND cartProducts.paymentStatus = 'not paid' " or die("Error fetchingt the data");
                    
                        $fetch_result = mysqli_query($link, $fetch_query) or die("Error executing query");
                        $num_rows = mysqli_num_rows($fetch_result);
    
                        $fetch_user_data = "SELECT firstName, streetName, number, zipCode, municipality FROM customer WHERE customerID = '$userID'" or die("Error fetching the data");
                        $fetch_user_result = mysqli_query($link, $fetch_user_data) or die("Could not execute the query");
                        $fetch_rows = mysqli_fetch_array($fetch_user_result);
    
                        $name = htmlspecialchars($fetch_rows['firstName']);
                        $street = htmlspecialchars($fetch_rows['streetName']);
                        $number = htmlspecialchars($fetch_rows['number']);
                        $zip = htmlspecialchars($fetch_rows['zipCode']);
                        $municipality = htmlspecialchars($fetch_rows['municipality']);
                        $shippingAddress = "$street, $number - $zip $municipality";
                        $total = 0;
    
                        if($num_rows > 0){
                            echo("<h2>Order shipped to: $shippingAddress</h2><hr/>");
    
                            echo("<table>");
                            echo("<th>Movie</th><th>Name</th><th>Price</th><th colspan=\"3\">Quantity");
                                while($row = mysqli_fetch_array($fetch_result)){
                                    $image = htmlspecialchars($row['image']);
                                    $name = htmlspecialchars($row['productName']);
                                    $price = htmlspecialchars($row['total']);
                                    $quantity = htmlspecialchars($row['quantity']);
                                    
                                    echo("<tr>");
                                        echo("<td><img src=\"" . $image . "\" class=\"cartImage\"/></td>");
                                        echo("<td>" . $name . "</td>");
                                        echo("<td>" . $price . "$</td>");
                                        echo("<td class=\"quantity\">" . $quantity . "</td>");
                                    echo("</tr>");
    
                                    $total += $price;
                                }
                            echo("</table>"); 
                            echo("<p class=\"total\">Total spent: $total$</p>");
    
                            echo("<a href=\"./setPaymentStatus.php\"><button class=\"button\">Continue shopping</button></a>");
                        } 
                    }
                ?>
            </div>
        </div>
    </body>
</html>