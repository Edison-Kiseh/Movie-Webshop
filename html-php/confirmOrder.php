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
        <link href="../css/confirmOrder.css" rel="stylesheet"/>
    </head>

    <body class="body">
        <?php
            $id = $_SESSION['id'];
            if(!$id){//redirect to home is no session id was found
                header("Location: ./home.php");
            }

            $user_query = "SELECT * FROM customer WHERE customerID = $id" or die("Error fetching the data");
            $user_result = mysqli_query($link, $user_query) or die("Could not execute the query");
            $user_details = mysqli_fetch_array($user_result);
            
            $fetch_query = "SELECT * FROM cartProducts LEFT JOIN cart ON cart.cartID = cartProducts.cartID LEFT JOIN products ON products.productID = cartProducts.productID WHERE cart.customerID = '$id' AND paymentStatus = 'not paid'" or die("Error fetchingt the data");
            $fetch_result = mysqli_query($link, $fetch_query) or die("Error executing query");
        ?>

        <h3>Below are your current details, do you want to proceed?</h3>

        <?php
            $street = htmlspecialchars($_POST['street']);
            $zip = htmlspecialchars($_POST['zip']);
            $municipality = htmlspecialchars($_POST['municipality']);
            $number = htmlspecialchars($_POST['number']);
            $total = $_SESSION['total'];

            $_SESSION['street'] = $street;
            $_SESSION['zip'] = $zip;
            $_SESSION['municipality'] = $municipality;
            $_SESSION['number'] = $number;

            echo("<div class=\"container\">");
                echo("<div class=\"personal-info\">");
                    echo("<h4>Personal information</h4><hr/>");
                    echo("<p><b>Full name:</b> " . $user_details['firstName'] . " " . $user_details['lastName'] . "</p>");
                    echo("<p><b>Email: </b>" . $user_details['email'] . "</p>");
                    echo("<p><b>Address:</b> $street, $number - $zip $municipality" . "</p>");
                echo("</div>");

                echo("<div>");
                    echo("<h4>Order information</h4><hr/>");
                    while($orders = mysqli_fetch_array($fetch_result)){
                        $name = htmlspecialchars($orders['productName']);
                        $price = htmlspecialchars($orders['price']);
                        $quantity = htmlspecialchars($orders['quantity']);

                        echo("<b>$name:</b> $price$ X $quantity = " . $price*$quantity . "$<br/>");
                    }
                    echo("<hr/><p class=\"total\"><b>Total:</b> $total$</p>");
                echo("</div>");
            echo("</div>");

            echo("<a href=\"./orderProcess.php\"><button class=\"orderConfirm\">Confirm order</button></a>");
            echo("<a href=\"./shoppingCart.php\"><button>Back to cart</button></a>");

            mysqli_close($link);
        ?>
    </body>
</html>