<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="index.php">LoopEats</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order.php">Order</a>
            </li>
            <!--<li class="nav-item">
                <a class="nav-link" href="menu.php">Menu</a>
            </li>-->
            <!--<li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>-->

            <?php
            //if(count($_SESSION['cart'])){
                echo "<li class=\"nav-item\">";
                echo "<a class=\"nav-link\" href=\"cart.php\">Cart</a>";
                echo "</li>";
            //}

            if(isset($_SESSION['login'])){
                echo "<li class=\"nav-item\">";
                echo "<a class=\"nav-link\" href=\"staff.php\">Management</a>";
                echo "</li>";

                echo "<li class=\"nav-item\">";
                echo "<a class=\"nav-link\" href=\"scripts/php/logout.php\">Log out</a>";
                echo "</li>";
            }
            else{
                echo "<li class=\"nav-item\">";
                echo "<a class=\"nav-link\" href=\"login.php\">Log in</a>";
                echo "</li>";
            }

            ?>
        </ul>
    </div>
</nav>