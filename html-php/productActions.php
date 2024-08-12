<?php
    session_start();
    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    if(isset($_GET['productAction'])){

        if($_GET['productAction'] == "removeProduct"){  
            $productId = $_GET['pid'];
            $query = "UPDATE products SET removeProduct = 'yes' WHERE productID = $productId" or die("Error: There was an error executing the query");
            mysqli_query($link, $query) or die('Error: there has been an error executing the query');

            header("Location: ./manageProducts.php?message=removed");
        }
        else if($_GET['productAction'] == "modifyProduct"){
            $productId = $_GET['pid'];

            header("Location: ./updateProduct.php?pid=$productId");
        }
        else if($_GET['productAction'] == "addProduct"){
            header("Location: ./addProduct.php");
        }
    }
    else{
        header("Location: ./home.php");
    }

    mysqli_close($link);
?>