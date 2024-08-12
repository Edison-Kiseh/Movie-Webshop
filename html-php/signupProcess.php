<?php
    session_start();
    include_once "logging/ErrorHandling.php";
    //include_once "logging/ExceptionHandling.php";

    $user =  'Webuser';
    $password = 'Lab2021';
    $database = 'tenflixDB';
    $host = 'localhost';

    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to $host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    function createCart($link, $id){
        //creating a cart for my customers
        $cart_query = "INSERT INTO cart(customerID) VALUES('$id')" or die("Could not create cart");
        mysqli_query($link, $cart_query) or die("Failed to execute cart query");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login Process</title>
    </head>

    <body>
        <?php
            if(isset($_POST['register'])){

                if($_POST['password'] != $_POST['password2']){
                    header("Location: ./signup.php?pass=notTheSame");
                }

                $firstName = htmlspecialchars($_POST['fname']);
                $lastName = htmlspecialchars($_POST['lname']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                //validating email a second time incase a user does the following user@user@gmail.com

                //was going to use the below exception handler to do the above task but turns our the email fields already check for this automatically

                /*try{
                    if(filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)){
                        //throwing an email if it is invalid
                        throw new MyException("Error: User entered: '".$email."' which is not a valid email");
                    }
                }
                catch(MyException $e){
                    $e->HandleException();
                }

                catch(Exception $e){
                    $e->getMessage();
                }*/

                function addCustomer($link, $firstName, $lastName, $email, $hashed_password){
                    $create_customer_query = "INSERT INTO customer(firstname, lastname, email, password) 
                    VALUES ('".$firstName."', '".$lastName."', '".$email."', '".$hashed_password."')";

                    mysqli_query($link, $create_customer_query) or die('Error: there has been an error executing the query');
                }
    
                function userExists($link, $email){
                    //check if user exists
                    $query = "SELECT * FROM customer WHERE email = '$email'" or die("Error fetching username from database");
                    $result = mysqli_query($link, $query) or die('Error: there has been an error executing the query');
                    $user = mysqli_num_rows($result);

                    return $user;
                }

                function getID($link, $email){
                    //check if user exists
                    $query = "SELECT customerID FROM customer WHERE email = '$email'" or die("Error fetching username from database");
                    $result = mysqli_query($link, $query) or die('Error: there has been an error executing the query');
                    $id = mysqli_fetch_array($result);

                    return $id;
                }

                if(isset($_GET['adminUserAdd'])){//if the user add is coming from the admin page
                    $user = userExists($link, $email);

                    if($user){
                        header("Location: ./manageUsers.php?message=userExists");
                    }
                    else{
                        addCustomer($link, $firstName, $lastName, $email, $hashed_password);
                        $id = getID($link, $email);
                        createCart($link, $id['customerID']);
                        header("Location: ./manageUsers.php?message=added");
                    }
                }
                else{
                    $user = userExists($link, $email);

                    if(!$user){
                        addCustomer($link, $firstName, $lastName, $email, $hashed_password);

                        $id = getID($link, $email);
                        $_SESSION['id'] = htmlspecialchars($id['customerID']);
                        createCart($link, $_SESSION['id']);

                        header("Location: ./welcomeUser.php?action=registered");
                    }
                    else{
                        header("Location: ./signup.php?");
                    }

                }
            }
            else{
                header("Location: ./welcomeUser.php?action=registered");
            }

            mysqli_close($link);
        ?>
    </body>
</html>