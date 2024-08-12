<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../css/header.css" rel="stylesheet"/>
    </head>

    <body>
        <div class="container-trui" id="header-parent-container">
            <div class="container" id="header-container">
                <div col="6" class="left-side">
                    <a href="./index.php"><img src="../images/tenflix-white.png" alt="logo" class="logo"/></a>
                </div>
                <div col="6" class="right-side">
                    <?php
                        if(isset($_SESSION['id'])){
                            if($_SESSION['permissions'] == "registeredUserPermissions"){
                                echo("<a href=\"./displayOrder.php\" class=\"orders\">My orders</a>");
                                echo("<a href=\"./home.php\" class=\"shop\">Shop</a>");
                                echo("<a href=\"./shoppingCart.php\" class=\"cart\"><img src=\"../images/shopping-cart-icon.png\" alt=\"shopping cart icon\" class=\"shopping-cart\" title=\"your cart\"/></a>");
                                echo("<a href=\"./logout.php\" class=\"login\" id=\"loginLink\"><button class=\"button-login\" id=\"loginButton\">Log out</button></a>");  
                            }
                            else{
                                echo("<ul class=\"admin\"><li>Administrator</li><ul class=\"dropdown-content\"><a href=\"./manageUsers.php\"><li>Users</li></a><a href=\"./manageProducts.php\"><li>Products</li></a></ul></ul>");
                                echo("<a href=\"./displayOrder.php\" class=\"orders\">My orders</a>");
                                echo("<a href=\"./home.php\" class=\"shop\">Shop</a>");
                                echo("<a href=\"./shoppingCart.php\" class=\"cart\"><img src=\"../images/shopping-cart-icon.png\" alt=\"shopping cart icon\" class=\"shopping-cart\" title=\"your cart\"/></a>");
                                echo("<a href=\"./logout.php\" class=\"login\" id=\"loginLink\"><button class=\"button-login\" id=\"loginButton\">Log out</button></a>");  
                            }
                        }  

                        else{
                            echo("<a href=\"./home.php\" class=\"shop\">Shop</a>");
                            echo("<a href=\"./login.php\" class=\"cart\"><img src=\"../images/shopping-cart-icon.png\" alt=\"shopping cart icon\" class=\"shopping-cart\" title=\"your cart\"/></a>");
                            echo("<a href=\"./login.php\" class=\"login\" id=\"loginLink\"><button class=\"button-login\" id=\"loginButton\">Log in</button></a>");  
                        }                            
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>