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
        <title>Login Process</title>
    </head>

    <body>
        <?php
            if(isset($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email'])){
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                //validating email a second time incase a user does the following user@user@gmail.com

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

                //search to see if the username exists
                $query = "SELECT customerID, password FROM customer WHERE email = '$email'" or die("Error fetching username from database");
                $result = mysqli_query($link, $query) or die('Error: there has been an error executing the query');
                $user = mysqli_num_rows($result);
                
                if($user){
                    $query_result = mysqli_fetch_array($result);

                    //for some reason i noticed that my fetch returns as an array of two keys 0 and password
                    $password_match = password_verify($password, $query_result['password']);

                    if($password_match){
                        $_SESSION['id'] = $query_result['customerID'];
                        
                        header("Location: ./welcomeUser.php?action=loggedIn");
                    }
                    else{
                        header("Location: ./login.php?action=incorrectPass");
                    }
                }

                else{
                    header("Location: ./login.php?action=not_found");
                }
            }
            else{
                header("Location: ./home.php");
            }

            mysqli_close($link);
        ?>
    </body>
</html>