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
        <title>Welcome to shop</title>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/welcomeUser.css" rel="stylesheet"/>
        <link href="../css/footer.css" rel="stylesheet"/>
        <link href="../css/popus.css" rel="stylesheet"/>
    </head>

    <body style="background-color: #041d2f;" id="page">
        <div class="content">
            <?php
            //different messages to display depending on if the user is logging in or registering an account
                if($_GET['action'] == "loggedIn" || $_GET['action'] == "registered"){
                    $id = $_SESSION['id'];

                    $query = "SELECT firstName FROM customer WHERE customerID = '$id'" or die("Error fetching id from database");
                    $result = mysqli_query($link, $query) or die('Error: there has been an error executing the query');
                    $data = mysqli_fetch_array($result);
        
                    $firstname = htmlspecialchars($data['firstName']);

                    echo $_GET['action'] == "loggedIn" ? "<h1>You are in!</h1>" : "<h1>Welcome to tenflix $firstname</h1>";
                    echo("<div class=\"container\">");
                    echo("<img src=\"../images/tenflix-white.png\" alt=\"logo\" />");

                    if($_GET['action'] == "loggedIn"){
                        echo("<h3>Welcome back to the shop " . $firstname . "</h3>");
                    }
                    else if($_GET['action'] == "registered"){
                        echo("<h3>Your account has been registered successfully!</h3>"); 
                    }

                    //check for the user rights
                    $query = "SELECT permissions FROM customer WHERE customerID = '$id'" or die("Error fetching username from database");
                    $result = mysqli_query($link, $query) or die('Error: there has been an error executing the query');
                    
                    $permissions = mysqli_fetch_array($result);

                    if($permissions['permissions'] == "user"){
                        $_SESSION['permissions'] = "registeredUserPermissions";
                    }
                    else if($permissions['permissions'] == "administrator") {
                        $_SESSION['permissions'] = "adminPermissions";
                    }

                    echo("<a href=\"./home.php\" class=\"home\"><button>Go to shop</button></a>");
                    echo("</div>");
                }

                if($_GET['action'] == "loggedout"){
                    echo("<h1>See you later!</h1>");
                    echo("<div class=\"container\">");
                    echo("<img src=\"../images/tenflix-white.png\" alt=\"logo\" />");
                    echo("<h3>You have been successfully signed out</h3>");
                    echo("<a href=\"./home.php\" class=\"home\"><button>Back to shop</button></a>");
                    echo("</div>");
                }

                mysqli_close($link);
            ?>
        </div>
    </body>
</html>