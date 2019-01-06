<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 06.01.2019
 * Time: 12:08
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test</title>
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="menu.php">All menu items</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="menu.php">Vegan friendly</a>
                    <a class="dropdown-item" href="menu.php">Gluten free</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="staff.php">Our staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Log in</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-1"></div>
        <div class="col-md-4 col-lg-4 col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><strong>Sign In </strong></div>
                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter e-mail">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-1"></div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
