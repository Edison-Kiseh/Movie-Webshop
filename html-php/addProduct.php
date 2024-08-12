<?php
    session_start();
    include_once "logging/ErrorHandling.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="../css/addProduct.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
        <script>
            function check()//To make sure that the form has been filled
            {
                var productname = document.getElementById('pname').value;
                var price = document.getElementById('price').value;
                var pg = document.getElementById('pg').value;
                var rating = document.getElementById('rating').value;
                var duration = document.getElementById('duration').value;
                var release = document.getElementById('release').value;

                if(productname  == "" || price == "" || pg == "" || rating == "" || duration == "" || release == "")
                {
                    if(productname == "")
                    {
                        document.getElementById("pname").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("pname").placeholder = ""
                    }

                    if(price == "")
                    {
                        document.getElementById("price").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("price").placeholder = ""
                    }

                    if(pg == "")
                    {
                        document.getElementById("pg").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("pg").placeholder = ""
                    }
                    
                    if(rating == "")
                    {
                        document.getElementById("rating").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("rating").placeholder = ""
                    }

                    if(duration == "")
                    {
                        document.getElementById("duration").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("duration").placeholder = ""
                    }

                    if(release == "")
                    {
                        document.getElementById("release").placeholder = "This field is required!"
                    }
                    else
                    {
                        document.getElementById("release").placeholder = ""
                    }

                    return false;
                }

                return true;
            }
            </script>
    </head>

    <body style="background-color: #041d2f;">
        <div class="content">
            <h3>Add a new movie</h3>
            <?php
                //message to display if the movie already exists
                if(isset($_GET['action'])){
                    if($_GET['action'] == "found"){
                        echo("<span style=\"color: red\">This movie already exists</span>");
                    }
                }
            ?>

            <form action="./processProduct.php" method="post" onsubmit="return check()">
                <div class="sets">
                    <div class="set1">
                        <div class="fields">
                            <span><i>Movie name *</i></span><br/>
                            <input type="text" name="pname" placeholder="Movie name" id="pname"/>
                        </div>

                        <div class="fields">
                            <span><i>Price *</i></span><br/>
                            <input type="text" name="price" placeholder="Movie price" id="price"/>
                        </div>

                        <div class="fields">
                            <span><i>Parental guidance *</i></span><br/>
                            <input type="text" name="pg" placeholder="PG" id="pg"/>
                        </div>

                        <div class="fields">
                            <span><i>Rating *</i></span><br/>
                            <input type="text" name="rating" placeholder="Rating" id="rating"/>
                        </div>

                        <div class="fields">
                            <span><i>Duration *</i></span><br/>
                            <input type="text" name="duration" placeholder="Duration" id="duration"/>
                        </div>

                    </div>

                    <div class="set2">
                        <div class="fields">
                            <span><i>Release date *</i></span><br/>
                            <input type="text" name="release" placeholder="Release date" id="release"/>
                        </div>

                        <div class="fields">
                            <span><i>Actors</i></span><br/>
                            <input type="text" name="actors" placeholder="Movie actors" id="actors"/>
                        </div>

                        <div class="fields">
                            <span><i>Director</i></span><br/>
                            <input type="text" name="director" placeholder="Movie director" id="director"/>
                        </div>

                        <div class="fields">
                            <span><i>Image</i></span><br/>
                            <input type="text" name="image" placeholder="Image path" id="image"/>
                        </div>
                    </div>
                </div>

                <div class="fields">
                    <span><i>Description</i></span><br/>
                    <input type="text" name="description" placeholder="Movie description" id="des"/>
                </div>

                <input type="submit" name="register" value="Add movie" class="register"/>
            </form>
        </div>
    </body>
</html>