<?php
    session_start();
    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    //update payment status of paid items
    $cart_query = "UPDATE cartProducts INNER JOIN cart ON cart.cartID = cartProducts.cartID SET paymentStatus = 'paid' WHERE cart.customerID = '".$_SESSION['id']."'" or die("Error updating table");
    mysqli_query($link, $cart_query) or die("Could not execute query");

    mysqli_close($link);

    header("Location: ./home.php");
?>
