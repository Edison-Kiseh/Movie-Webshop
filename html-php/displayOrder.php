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
    </head>

    <body style="background-color: #041d2f;">
        <?php
            include("./header.php");
        ?>

        <div class="container-trui" id="container-trui"> 
            <h1>Your orders</h1>
            <div class="container" id="child-container">
                <?php
                    $userID = $_SESSION['id'];

                    if(!$userID){//redirect to home is no session id was found
                        header("Location: ./home.php");
                    }

                    $fetch_query = "SELECT image, productName, SUM(total) as total, SUM(quantity) as quantity FROM cartProducts LEFT JOIN cart ON cart.cartID = cartProducts.cartID LEFT JOIN products ON products.productID = cartProducts.productID WHERE cart.customerID = '$userID' AND cartProducts.paymentStatus = 'paid' GROUP BY cartProducts.productID " or die("Error fetchingt the data");

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
                        echo("<h2>Orders by $name</h2><hr/>");
                    
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
                    }
                    
                    else{
                        echo("<h2 class=\"message\">You haven't placed any orders</h2>");
                    }

                    mysqli_close($link);
                ?>
            </div>
        </div>
    </body>
</html>