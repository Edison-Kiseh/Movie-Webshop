<?php
    session_start();
    include_once "logging/ErrorHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    if(isset($_GET['userAction'])){

        if($_GET['userAction'] == "removeUser"){  
            #header("Location: ./manageUsers.php?confirm=userDel");
            $userId = $_GET['uid'];
            $query = "UPDATE customer SET userRemoved = 'yes' WHERE customerID = $userId" or die("Error: There was an error executing the query");
            mysqli_query($link, $query) or die('Error: there has been an error executing the query');

            header("Location: ./manageUsers.php?message=removed");
        }
        else if($_GET['userAction'] == "changePermissions"){
            $userId = $_GET['uid'];
            //first check what the current user permissions are and from there...
            $getPermissions = "SELECT permissions FROM customer WHERE customerID = $userId" or die("Error: could not fetch the data");
            $result = mysqli_query($link, $getPermissions) or die("Error: could not execute query");
            $permission = mysqli_fetch_array($result);

            if($permission['permissions'] == "user"){
                $query = "UPDATE customer SET permissions = 'administrator' WHERE customerID = $userId" or die("Error: There was an error executing the query");
                mysqli_query($link, $query) or die('Error: there has been an error executing the query');
            }
            else if($permission['permissions'] == "administrator"){
                $query = "UPDATE customer SET permissions = 'user' WHERE customerID = $userId" or die("Error: There was an error executing the query");
                mysqli_query($link, $query) or die('Error: there has been an error executing the query');
            }

            header("Location: ./manageUsers.php?message=permissionChanged");
        }
        else if($_GET['userAction'] == "addUser"){
            header("Location: ./userInfo.php");
        }
    }
    else{
        header("Location: ./home.php");
    }

    mysqli_close($link);
?>