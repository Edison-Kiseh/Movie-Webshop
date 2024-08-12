<?php
    session_start();
    include_once "logging/ErrorHandling.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="../css/signup.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
        <script>
            function reEnterPassword(){
                document.getElementById('pass').placeholder = "Both password do not correspond";
                document.getElementById('pass2').placeholder = "Both password do not correspond";
            }

            function check()//To make sure that the form has been filled
            {
                var firstname = document.getElementById('fname').value;
                var lastname = document.getElementById('lname').value;
                var email = document.getElementById('email').value;
                var password1 = document.getElementById('pass').value;
                var password2 = document.getElementById('pass2').value;
                var fieldCheck = 0;

                if(firstname == "" || lastname == "" || email == "" || password1 == "" || password2 == "")
                {
                    if(firstname == "")
                    {
                        document.getElementById("fname").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("fname").placeholder = ""
                        fieldCheck++;
                    }

                    if(lastname == "")
                    {
                        document.getElementById("lname").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("lname").placeholder = ""
                        fieldCheck++;
                    }

                    if(email == "")
                    {
                        document.getElementById("email").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("email").placeholder = ""
                        fieldCheck++;
                    }
                    
                    if(password1 == "")
                    {
                        document.getElementById("pass").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("pass2").placeholder = ""
                        fieldCheck++;
                    }

                    if(password2 == "")
                    {
                        document.getElementById("pass2").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("pass2").placeholder = ""
                        fieldCheck++;
                    }
                    
                    return false;
                }

                return true;
            }
            </script>
    </head>

    <body style="background-color: #041d2f;">
        <div class="content">
            <h1>Sign up</h1>
            <?php
            //message to display if the user already exists
                if(isset($_GET['action'])){
                    if($_GET['action'] == "found"){
                        echo("<span class=\"notice\">The user already exists, log in instead.</span>");
                    }
                }

                //checking if both passwords correspond, i tried doing it with js alone but it didn't seem to work
                if(isset($_GET['pass'])){
                    if($_GET['pass'] == "notTheSame"){
                        echo("<span class=\"notice\">The password should be the same</span>");
                    }
                }
            ?>

            <form autocomplete="off" action="./signupProcess.php" method="post" onsubmit="return check()">
                <div class="fields">
                    <span><i>First name</i></span><br/>
                    <input type="text" name="fname" placeholder="Your first name" id="lname"/>
                </div>

                <div class="fields">
                    <span><i>Last name</i></span><br/>
                    <input type="text" name="lname" placeholder="Your last name" id="fname"/>
                </div>

                <div class="fields">
                    <span><i>Email</i></span><br/>
                    <input type="email" name="email" placeholder="Your email" id="email"/>
                </div>

                <div class="fields">
                    <span><i>Password</i></span><br/>
                    <input type="password" name="password" placeholder="Your password" id="pass"/>
                </div>

                <div class="fields">
                    <span><i>Password confirmation</i></span><br/>
                    <input type="password" name="password2" placeholder="Repeat your password" id="pass2"/>
                </div>

                <input type="submit" name="register" value="Register" class="register"/>
            </form>
            <p style="text-align: center;">Already have an account?<a href="./login.php"> Sign in!</a></p>
        </div>
    </body>
</html>