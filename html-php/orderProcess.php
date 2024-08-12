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
    </head>

    <body>
        <?php
            $id = $_SESSION['id'];
            $street = $_SESSION['street'];
            $number = $_SESSION['number'];
            $zip = $_SESSION['zip'];
            $municipality = $_SESSION['municipality'];

            $shippingAddress = "$street, $number - $zip $municipality";

            $user_query = "SELECT streetName, number, zipCode, municipality FROM customer WHERE customerID = $id" or die("Error fetching the data");
            $user_result = mysqli_query($link, $user_query) or die("Could not execute the query");
            $user_num_rows = mysqli_num_rows($user_result);

            //update user details
            if($user_num_rows){
                $query = "UPDATE customer SET streetName = '$street', number = '$number', zipCode = '$zip', municipality = '$municipality' WHERE customerID = '$id'" or die("Error updating table");
                mysqli_query($link, $query) or die("Could not execute query");
            }
            else{
                $query = "INSERT INTO customer(streetName, number, zipcode, municipality) VALUES ('$street', '$number', '$zip', '$municipality') WHERE customerID = '$id'" or die("Could not insert into table");
                mysqli_query($link, $query) or die("Could not execute query");
            }
            //update order table
            $order_query = "INSERT INTO orders(orderDate, shippingAddress, customerID) VALUES ('".date('Y-m-d')."', '$shippingAddress', '$id')" or die("Error inserting into table");
            mysqli_query($link, $order_query) or die("Error executing the query");

            //update order details table
            $fetch_quantity = "SELECT quantity, productID FROM cartProducts LEFT JOIN cart ON cart.cartID = cartProducts.cartID WHERE paymentStatus = 'not paid' AND customerID = '$id'" or die("Could not fetch the data");
            $quantity_result = mysqli_query($link, $fetch_quantity) or die("Could not execute the query");
            $data = array();

            $order_query = "SELECT orderID FROM orders WHERE customerID = '$id' ORDER BY orderID DESC" or die("Could not fetch the data");
            $order_result = mysqli_query($link, $order_query) or die("Could not execute the query");
            $orderID = mysqli_fetch_array($order_result);

            while($data = mysqli_fetch_array($quantity_result)){
                $ordertails_query = "INSERT INTO orderDetails(orderID, productID, quantity) VALUES ('".$orderID['orderID']."','".$data['productID']."', '".$data['quantity']."')" or die("Could not insert in to the table");
                mysqli_query($link, $ordertails_query);
            }
            
            mysqli_close($link);
            
            header("Location: ./showOrderConfirm.php?order=true");
        ?>
    </body>
</html>