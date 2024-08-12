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
        <title>Administrator page</title>
        <link href="../css/reset.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/manageUser.css" rel="stylesheet"/>
        <link href="../css/header.css" rel="stylesheet" />
    </head>

    <body style="background-color: #041d2f;">
        <div class="container-trui">
            <?php include("./header.php");?>

            <h1>Manage users</h1>

            <?php
                if(isset($_GET['message'])){
                    echo("<div class=\"displayText\">");//Text to display depending on the user action
                        if($_GET['message'] == "removed"){
                            echo("<h4>The user has been removed</h4>");
                        }
                        else if($_GET['message'] == "added"){
                            echo("<h4>The user has been created successfully</h4>");
                        }
                        else if($_GET['message'] == "permissionChanged"){
                            echo("<h4>The user's permissions have been changed</h4>");
                        }
                        else if($_GET['message'] == "userExists"){
                            echo("<h4>This user already exists</h4>");
                        }
                    echo("</div>");
                }
            ?>

            <div class="container" id="content">
                <?php
                    $user_query = "SELECT customerID, firstName, lastName, email, permissions, userRemoved FROM customer" or die("Could not fetch the data from the database");
                    $user_result = mysqli_query($link, $user_query) or die("There was an error executing the query");

                    $user_row = array();
                ?>
                <table>
                    <th class="uid">UserID</th><th>First name</th><th>Last name</th><th class="email">Email</th><th>Permissions</th>
                    <?php
                        while($user_row = mysqli_fetch_array($user_result)){
                            if(htmlspecialchars($user_row['userRemoved']) == "no"){
                                echo("<tr>");
                                    echo("<td>" . htmlspecialchars($user_row['customerID']) . "</td>");
                                    echo("<td>" . htmlspecialchars($user_row['firstName']) . "</td>");
                                    echo("<td>" . htmlspecialchars($user_row['lastName']) . "</td>");
                                    echo("<td>" . htmlspecialchars($user_row['email']) . "</td>");
                                    echo("<td>" . htmlspecialchars($user_row['permissions']) . "</td>");
                                    echo("<td><a href=\"./userActions.php?uid=" . $user_row['customerID'] . "&userAction=removeUser\"><button class=\"remove\">Remove</button></a></td>");
                                    echo("<td><a href=\"./userActions.php?uid=" . $user_row['customerID'] . "&userAction=changePermissions\"><button>Change permissions</button></a></td>");
                                echo("</tr>");
                            }
                        } 
                    ?>
                </table>
                <hr/>
                <?php
                    echo("<a href=\"./userActions.php?userAction=addUser\"><button class=\"adduser\">Add user</button></a>");
                    mysqli_close($link);
                ?>
            </div>
        </div>
    </body>
</html>