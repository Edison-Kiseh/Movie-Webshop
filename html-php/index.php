<?php
    session_start();
    include_once "logging/ErrorHandling.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Welcome</title>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="../css/index.css" rel="stylesheet"/>
        <link href="../css/footer.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body style="background-color: #041d2f;">

        <div class="top-image">
            <img src="../images/movies/movie-collection.png" alt="movie collection" class="image"/>
        </div>

        <div class="container">
            <img src="../images/tenflix-white.png" alt="Website logo" class="tenflix"/>
            <h1>Unleash the Magic of Movies, Anytime, Anywhere</h1>
            <p class="notes">Explore, purchase and enjoy a vast collection of movies from the comfort of your own screen.</p>
            <a href="./home.php" class="home"><button class="go-home">Go home<img src="../images/house_image.png" alt="house image" class="house-image"/></button></a>

            <div class="content">
                <h5>About tenflix</h5>
                <p>Welcome to TenFlix, where the magic of cinema meets the convenience of your screen. As your premier destination for unparalleled cinematic entertainment, we take pride in redefining your movie-watching experience. At TenFlix, we've curated a vast and diverse collection of films that spans the entire spectrum of genres, ensuring there's something for every discerning viewer.</p>

                <p>Immerse yourself in a world of captivating narratives, mesmerizing visuals, and unforgettable characters. Whether you're a fan of heartwarming dramas, pulse-pounding action, mind-bending sci-fi, or laugh-out-loud comedies, our extensive library is designed to cater to every taste and preference.</p>

                <p>What sets TenFlix apart is our commitment to providing you with more than just movies; we offer an experience that transcends the ordinary. Explore our carefully curated selection, where timeless classics seamlessly coexist with the latest releases, forming a rich tapestry of storytelling that has the power to transport you to different worlds and evoke a myriad of emotions.</p>

                <p>In the realm of technology, we harness cutting-edge innovations to deliver a home cinema experience like no other. Enjoy high-definition streaming with crystal-clear audio, bringing the magic of the big screen directly to your living room. Our platform is designed for seamless navigation, ensuring you can effortlessly discover new favorites or revisit beloved classics.</p>

                <p>At TenFlix, we understand that movie-watching is not just a pastime; it's an art form, a shared experience that brings people together. Join our vibrant community of cinephiles, where you can stay informed about the latest releases, engage in discussions with fellow movie enthusiasts, and make every movie night an event to remember.</p>

                <p>Your cinematic journey begins here at TenFlix, where we invite you to explore, experience, and embark on a voyage of storytelling like never before. Welcome to the future of entertainment – welcome to TenFlix!</p>
            </div>
        </div>
        <?php include("./footer.html");?>
    </body>
</html>