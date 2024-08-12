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
        <title>Shop</title>
        <link href="../css/reset.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/home.css" rel="stylesheet" />
        <link href="../css/header.css" rel="stylesheet"/>
        <link href="../css/footer.css" rel="stylesheet"/>

        <script src="../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".card").hover(function(){
                    $(this).css("border", "1px solid white");
                });
                $(".card").mouseout(function(){
                    $(this).css("border", "1px solid #041d2f");
                });

                //group movies by genre
                $("#genreSelect").change(function() {
                    var selectedGenre = $(this).val();//selecting the value of the select statement
                    fetchMovies(selectedGenre);
                });

                // Function to fetch and display movies based on the selected genre
                function fetchMovies(genre) {
                    $.ajax({
                    url: 'genreMovieList.php', 
                    type: 'POST',
                    data: { genre: genre },
                    success: function(data) {
                        // Update the movie-container div with the received data
                        $("#movie-container").fadeOut(100, function(){
                            $(this).html(data);
                            $(this).fadeIn(500);
                        });
                        
                    },
                    error: function(error) {
                        console.error("Error fetching movies:", error);
                    }
                    });
                }
                // Initial fetch to load all movies
                fetchMovies('all');

                //fetching the movies based on a search
                $("#search").keyup(function()
                {
                    $searchString = $("#search").val();
                    console.log($searchString);
                    
                    $request = $.ajax({
                        method:"POST",
                        url:"searchMovieList.php",
                        data: {search: $searchString},
                    });
                    
                    $request.done(function(data)
                    {
                        $("#movie-container").fadeOut(100, function()
                        {
                            $(this).html(data);
                            $(this).fadeIn(500);
                        });
                        
                    });
                    
                    $request.fail(function(jqXHR, textStatus)
                    {
                        $("#movie-container").html("Request failed: " + textStatus);
                    });
                    
                });
            });

            var array = ["../images/movies/dune-movie-poster.jpg", "../images/movies/dead reckoning.jpg", "../images/movies/john-wick-landscape.jpg", "../images/movies/james-bond.jpg"];
            var slides;

            var i = 0;

            function load(){
                slides = document.getElementById('slideshow');
            }
            function showSlide(){
                slides.src = array[i];
                i++;
                if(i >= array.length)
                {
                    i = 0;
                }
            }
        
            function startSlideShow()
            {
            setInterval(showSlide, 3000);
            clearInterval(showSlide, 3000);
            }
        </script>
    </head>

    <body onload="startSlideShow(), load()">
        <?php include('./header.php');?>

        <div class="top">
            <img src="../images/movies/james-bond.jpg" alt="slideshow" id="slideshow"/>
            <a href="#genreSelect" class="shopnow"><button>Shop now</button></a>
        </div>

        <p class="message"><span class="msg1">Browse our unique collection of movies...</span><br/><br/><br/><span class="msg2">A collection so wide that you'll never be left unentertained and all at very affrodable prices! Please feel free to explore and feast you eyes.</span></p>

        <div class="container-trui" id="parent-container">
            <div class="sortandsearch">
                <!--To group my movies based on their genres-->
                <label for="genreSelect" class="genre">Genre:</label>
                <select id="genreSelect" name="genre">
                    <option value="all">All</option>
                    <option value="adventure">Adventure</option>
                    <option value="action">Action</option>
                    <option value="sci-fi">SCI-FI</option>
                    <option value="crime">Crime</option>
                    <option value="romance">Romance</option>
                    <option value="thriller">Thriller</option>
                </select>

                <div class="search">
                    <input type="text" name="search" placeholder="Search movies..."  class="search-bar" id="search"/>
                </div>
            </div>

            <div class="container" id="movie-container"><!--division to display the movies-->

            </div>
        </div>

        <?php include('./footer.html');?>
    </body>
</html>