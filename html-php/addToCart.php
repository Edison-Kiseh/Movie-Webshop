<?php
    session_start();

    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    function fetchCartID($link){
        $userID = $_SESSION['id'];

        $query_cart = "SELECT cartID FROM cart WHERE customerID = '$userID'" or die("Error could not select from the database");
        $query_cart_result = mysqli_query($link, $query_cart) or die("Could not execute the query");
        $cartID = mysqli_fetch_array($query_cart_result);

        return $cartID;
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $image = $_GET['image'];
        $name = $_GET['name'];
        $price = $_GET['price'];
        $userID = $_SESSION['id'];

        if(!$userID){//redirect to home is no session id was found
            header("Location: ./home.php");
        }

        //$query = "SELECT * FROM cartProducts INNER JOIN products ON products.productID = cartProducts.productID INNER JOIN cart ON cart.cartID = cartProducts.cartID WHERE cartProducts.productID = '$id'" or die("Error could not select from the database");
        $query = "SELECT * FROM cartProducts WHERE productID = '$id'" or die("Error could not select from the database");
        $query_result = mysqli_query($link, $query) or die("Could not execute the query");
        $query_rows = mysqli_num_rows($query_result);
        $data = mysqli_fetch_array($query_result);

        if($query_rows == 0){
            $cartID = fetchCartID($link);

            $insert_query = "INSERT INTO cartProducts(cartID, productID, quantity, total) VALUES ('".$cartID['cartID']."','$id', 1, $price)" or die("Error inserting the data");
            $result = mysqli_query($link, $insert_query) or die("Error executing the query");
        }
    
        else{
            if($data['paymentStatus'] == "not paid"){//manipulating only the products that haven't been paid for
                $new_quantity = $data['quantity'] + 1;
                $new_price = $price * $new_quantity;
        
                $update_query = "UPDATE cartProducts SET quantity = '$new_quantity', total = '$new_price' WHERE productID = '$id'" or die("Error updating the data");
                $result = mysqli_query($link, $update_query) or die("Error executing the query");
            }
            else{
                $cartID = fetchCartID($link);

                $insert_query = "INSERT INTO cartProducts(cartID, productID, quantity, total) VALUES ('".$cartID['cartID']."','$id', 1, $price)" or die("Error inserting the data");
                mysqli_query($link, $insert_query) or die("Error executing the query");
            }
        }
    }
    elseif(isset($_GET['stock'])){
        $name = $_GET['name'];
        $userID = $_SESSION['id'];

        $query = "SELECT * FROM cartProducts INNER JOIN products ON cartProducts.productID = products.productID WHERE products.productName = '$name' AND paymentStatus = 'not paid'" or die("Error could not select from the database");
        $query_result = mysqli_query($link, $query) or die("Could not execute the query");
        $query_rows = mysqli_num_rows($query_result);
        $data = mysqli_fetch_array($query_result);

        $product_query = "SELECT productID FROM products WHERE productName = '$name'" or die("Could not fetch the data");
        $product_query_result = mysqli_query($link, $product_query) or die("Could not execute the query");
        $productID = mysqli_fetch_array($product_query_result);

        $query = "SELECT price FROM products WHERE productName = '$name'" or die("Error could not select from the database");
        $query_result = mysqli_query($link, $query);
        $original_price = mysqli_fetch_array($query_result);//getting the original price of the product

        if($_GET['stock'] == "plus"){
            $new_quantity = $data['quantity'] + 1;
            $new_price = $original_price['price'] * $new_quantity;

            $query = "UPDATE cartProducts SET quantity = '$new_quantity', total = '$new_price' WHERE paymentStatus = 'not paid' AND productID = '".$productID['productID']."'" or die("Error updating the data");
            mysqli_query($link, $query) or die("Could not execute the query");
        }
        else if($_GET['stock'] == "minus"){
            $select = "SELECT total FROM cartProducts LEFT JOIN products ON cartProducts.productID = products.ProductID WHERE productName = '$name' AND paymentStatus = 'not paid'" or die("Could not perform the select");
            $select_result = mysqli_query($link, $select);
            $totalPrice = mysqli_fetch_array($select_result);

            $new_quantity = $data['quantity'] - 1;
            $reduced_price = $totalPrice['total'] - $original_price['price'];
    
            $query = "UPDATE cartProducts SET quantity = '$new_quantity', total = '$reduced_price' WHERE paymentStatus = 'not paid' AND productID = '".$productID['productID']."'" or die("Error updating the data");
            mysqli_query($link, $query) or die("Could not execute the query");

            if($new_quantity == 0){
                $del_query = "DELETE cartProducts FROM cartProducts LEFT JOIN products ON cartProducts.productID = products.productID WHERE products.productName = '$name' AND paymentStatus = 'not paid'" or die("Error: problem deleting from cart");
                mysqli_query($link, $del_query);
            }
        }
    }
    else{
        header("Location: ./home.php");
    }

    mysqli_close($link);

    header("Location: ./shoppingCart.php?cart=addedToCart");
?>
