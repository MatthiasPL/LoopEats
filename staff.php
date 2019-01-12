<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 06.01.2019
 * Time: 12:08
 */
session_start();
include 'scripts/php/DataBase.php';
$db = new DataBase();
if(!isset($_SESSION['login'])){
    header('Location: '.'index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Staff</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/united.css">
    <link rel="stylesheet" href="css/LoopEats.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
    <?php include "parts/navbar.php"?>
    <div class="container">
        <div class="row">
            <?php
            if($db->checkManagerPrivileges($_SESSION['login'])){
                echo "            <div class=\"col-sm-12 col-md-4 col-lg-4 align-items-stretch\">\n";
                echo "                <div class=\"card h-100\">\n";
                echo "                    <div class=\"card-body\">\n";
                echo "                        <div class=\"card-title\"><strong><a href=\"staff_management.php\">Staff management</a></strong></div>\n";
                echo "                        <p class=\"card-text\">Allows you to register and remove staff.</p>\n";
                echo "                    </div>\n";
                echo "                </div>\n";
                echo "            </div>\n";
                echo "            <div class=\"col-sm-12 col-md-4 col-lg-4 align-items-stretch\">\n";
                echo "                <div class=\"card h-100\">\n";
                echo "                    <div class=\"card-body\">\n";
                echo "                        <div class=\"card-title\"><strong><a href=\"menu_management.php\">Menu management</a></strong></div>\n";
                echo "                        <p class=\"card-text\">Allows you to add and remove menu items.</p>\n";
                echo "                    </div>\n";
                echo "                </div>\n";
                echo "            </div>\n";
            }
            if($db->checkChefPrivileges($_SESSION['login'])){
                echo "            <div class=\"col-sm-12 col-md-4 col-lg-4 align-items-stretch\">\n";
                echo "                <div class=\"card h-100\">\n";
                echo "                    <div class=\"card-body\">\n";
                echo "                        <div class=\"card-title\"><strong><a href=\"order_management.php\">Orders</a></strong></div>\n";
                echo "                        <p class=\"card-text\">Check and receive orders.</p>\n";
                echo "                    </div>\n";
                echo "                </div>\n";
                echo "            </div>\n";
            }
            ?>
        </div>
    </div>

    <?php
    $db->close();
    ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
