<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 06.01.2019
 * Time: 12:08
 */
if(isset($_SESSION['login'])){
    header('Location: '.'staff.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
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
    <div class="alert alert-danger" id="error-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <div id="errormessage"></div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-1"></div>
        <div class="col-md-4 col-lg-4 col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><strong>Sign In</strong></div>
                    <form role="form" id="login-form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Login:</label>
                            <input type="login" class="form-control" id="loginInput" placeholder="Enter login" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password:</label>
                            <input type="password" class="form-control" id="passwordInput" placeholder="Enter password" required>
                        </div>
                        <button type="submit" id="button-login" class="btn btn-primary float-right">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-1">
            <div id="test"></div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validate.js"></script>
<script>
    $(document).ready(function(){
        $("#error-alert").hide();
        $("#login-form").submit(function(event){
            event.preventDefault();
            $.ajax({
                url: 'scripts/php/login.php',
                type: 'post',
                data: {
                    'login': document.getElementById('loginInput').value,
                    'password': document.getElementById('passwordInput').value
                },
                success: function(response){
                    if(response=="yes"){
                        window.location.replace("staff.php");
                    }else{
                        $("#errormessage").text("Wrong login and/or password");
                        $("#error-alert").slideDown(1500).delay(1000).slideUp(1500, function(){
                            $("#error-alert").fadeOut(500);
                        });
                    }
                },
                error: function (response) {
                    $("#errormessage").text("Cannot log in");
                    $("#error-alert").slideDown(1500).delay(1000).slideUp(1500, function(){
                        $("#error-alert").fadeOut(500);
                    });
                }
            });
        });
    });
    /*$(document).ready(function() {
        $("#error-alert").hide();
        $("#login-form").submit(function(){
            event.preventDefault();
            $.ajax({
                url: 'scripts/php/login.php',
                type: 'post',
                data: {
                    'login': document.getElementById('loginInput').value,
                    'password': document.getElementById('passwordInput').value
                },
                success: function(response){
                    if(response=="yes"){
                        window.location.replace("staff.php");
                    }else{
                        $("#errormessage").text("Wrong login and/or password");
                        $("#error-alert").slideDown(1500).delay(1000).slideUp(1500, function(){
                            $("#error-alert").fadeOut(500);
                        });
                    }
                },
                error: function (response) {
                    $("#errormessage").text("Cannot log in");
                    $("#error-alert").slideDown(1500).delay(1000).slideUp(1500, function(){
                        $("#error-alert").fadeOut(500);
                    });
                }
            });
        });
    }*/
</script>
</body>
</html>
