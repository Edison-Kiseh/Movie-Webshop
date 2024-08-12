<?php
    session_start();
    include_once "logging/ErrorHandling.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Contact</title>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/contact.css" rel="stylesheet"/>

        <script>
            function check()//To make sure that the form has been filled
            {
                var firstname = document.getElementById('fname').value;
                var lastname = document.getElementById('lname').value;
                var email = document.getElementById('email').value;
                var remark = document.getElementById('textarea').value;

                if(firstname == "" || lastname == "" || email == "" || remark == "")
                {
                    if(firstname == "")
                    {
                        document.getElementById("warning").innerHTML = "The above field is required!"
                    }
                    else
                    {
                        document.getElementById("warning").innerHTML = ""
                    }

                    if( lastname == "")
                    {
                        document.getElementById("warning1").innerHTML = "The above field is required!"
                    }
                    else
                    {
                        document.getElementById("warning1").innerHTML = ""
                    }
                    
                    if(email == "")
                    {
                        document.getElementById("warning2").innerHTML = "The above field is required!"
                    }
                    else
                    {
                        document.getElementById("warning2").innerHTML = ""
                    }

                    if(remark == "")
                    {
                        document.getElementById("warning3").innerHTML = "The above field is required!"
                    }
                    else
                    {
                        document.getElementById("warning3").innerHTML = ""
                    }

                return false;
                }

                return true;

            }
        </script>
    </head>

    <body>
        <div class="content">
            <?php include('./header.php');?>
            
            <div class="container">
                <h1>Get in touch and tell us what you think!</h1>

                <form action="mailto:r0937121@student.thomasmore.be" method="post" enctype="text/plain" onsubmit="return check()">
                    <p>
                        <label for="fname" >First name</label>
                        <span>&#42;</span><br />
                        <input type="text" id="fname" name="First name" class="input-field" placeholder="Your first name"/>
                        <p class="warnings" id="warning"></p>
                    </p>

                    <p>
                        <label for="lname">Last name</label>
                        <span>&#42;</span><br />
                        <input type="text" id="lname" name="Last name" class="input-field"  placeholder="Your last name"/>
                        <p class="warnings" id="warning1"></p>
                    </p>

                    <p>
                        <label for="email">Email</label>
                        <span>&#42;</span><br />
                        <input type="email" id="email" name="Email" class="input-field"  placeholder="Your email address"/>
                        <p class="warnings" id="warning2"></p>
                    </p>

                    <div class="remark">
                        Message
                        <span>&#42;</span><br />
                        <textarea id="textarea"  placeholder="Enter your message"></textarea>
                    </div>
                    <p class="warnings" id="warning3"></p>
                    
                    <p>
                    <input type="submit" name="send" class="button" value="Contact me" onclick="check()"/>
                    </p>
                </form> 
            </div>

        <?php include('./footer.html');?>
        </div>
    </body>
        
</html>