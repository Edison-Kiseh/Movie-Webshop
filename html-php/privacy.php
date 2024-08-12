<?php
    session_start();
    include_once "logging/ErrorHandling.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Privacy policy</title>
        <link href="../css/reset.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="../css/header.css" rel="stylesheet"/>
        <link href="../css/footer.css" rel="stylesheet"/>
        <link href="../css/privacy.css" rel="stylesheet"/>
    </head>

<body>
    <?php include('./header.php');?>

        <div class="container-trui" id="privacy-parent-container"> 
            
            <h1>Privacy Policy</h1>

            <div class="container" id="privacy-container">
                <p>Thank you for visiting Tenflix! We take your privacy seriously and are committed to safeguarding your personal information. Please take a moment to review our privacy policy to understand how we collect, use, and protect your data.</p>
                
                <p>Information We Collect:<br/>
                    We collect personal information, such as your name, email address, shipping address, and payment details, to process your orders and provide a personalized shopping experience.</p>
                    
                <p>How We Use Your Information:<br/>
                    Your information is used to fulfill orders, process payments, communicate with you about your purchase, and improve our services. We may also use your email address to send promotional updates and newsletters, but you can opt out at any time.</p>
                    
                <p> Data Security:<br/>
                    We implement industry-standard security measures to protect your personal information from unauthorized access, disclosure, alteration, and destruction. Your payment information is encrypted during transmission using secure socket layer technology (SSL).</p>
                    
                <p>Cookies:<br/>
                    We use cookies to enhance your browsing experience and analyze site traffic. You can control and manage cookie preferences through your browser settings.</p>
                    
                <p>Third-Party Disclosure:<br/>
                    We do not sell, trade, or otherwise transfer your personal information to outside parties unless necessary for order fulfillment or as required by law.</p>
                    
                <p>Your Rights:<br/>
                    You have the right to access, correct, or delete your personal information. If you have any concerns about the data we hold, please contact us.</p>
                    
                <p>Policy Changes:<br/>
                    We may update our privacy policy to reflect changes in our practices. Check this page regularly for updates.</p>
                    
                <p>By using our website, you consent to the terms outlined in this privacy policy.</p>
                    
                <p>If you have any questions or concerns, please contact us at r0937121@student.thomasmore.be .</p>
                    
                <p>Last updated: 14/11/2023</p>
            </div>

            <?php include("./footer.html")?>
        </div>
    </body>
</html>