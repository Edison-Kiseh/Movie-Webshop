<?php
    session_start();
    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    if(isset($_POST['pname'])){
        $movieName = htmlspecialchars($_POST['pname']);
        $price = htmlspecialchars($_POST['price']);
        $pg = htmlspecialchars($_POST['pg']);
        $rating = htmlspecialchars($_POST['rating']);
        $duration = htmlspecialchars($_POST['duration']);
        $release = htmlspecialchars($_POST['release']);
        $actors = htmlspecialchars($_POST['actors']);
        $director = htmlspecialchars($_POST['director']);
        $image = htmlspecialchars($_POST['image']);
        $description = htmlspecialchars($_POST['description']);

        //to first check if the product already exists
        $fetch_query = "SELECT * FROM products WHERE productName = '$movieName'" or die("Error fetching from database");
        $fetch_result = mysqli_query($link, $fetch_query) or die("Could not execute query");
        $fetch_rows = mysqli_num_rows($fetch_result);

        if($fetch_rows == 0){//perform query if the product doesn't exist in the DB
            $insert_query = "INSERT INTO products(productName, price, parentalGuidance, duration, releaseDate, director, actors, image, description, rating) VALUES ('$movieName', $price, '$pg', '$duration', '$release', '$director', '$actors', '$image', '$description', $rating)";
            mysqli_query($link, $insert_query) or die('Error: there has been an error executing the query');
    
            header("Location: ./manageProducts.php?message=added");
        }
        else{
            header("Location: ./addProduct.php?action=found");
        }
    }
    else{
        header("Location: ./home.php");
    }

    mysqli_close($link);
?>