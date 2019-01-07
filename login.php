<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 06.01.2019
 * Time: 12:08
 */
session_start();
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
<?php include "parts/navbar.php"?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-1"></div>
        <div class="col-md-4 col-lg-4 col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><strong>Sign In </strong></div>
                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Login:</label>
                            <input type="login" class="form-control" id="loginInput" placeholder="Enter login">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password:</label>
                            <input type="password" class="form-control" id="passwordInput" placeholder="Enter password">
                        </div>
                        <button type="button" id="button-login" class="btn btn-primary float-right">Sign in</button>
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
<script>
    $("#button-login").click(function(){
        $.ajax({
            url: 'scripts/php/login.php',
            type: 'post',
            data: {
                'login': document.getElementById('loginInput').value,
                'password': document.getElementById('passwordInput').value
            },
            success: function(response){
                alert(document.getElementById('loginInput').value);
                document.getElementById('test').innerHTML=response;
            }
        });
    });
</script>
</body>
</html>
