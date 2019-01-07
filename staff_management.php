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
    <div class="alert alert-danger" id="error-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <div id="errormessage"></div>
    </div>
    <div id="list"></div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $( document ).ready(function() {
        $.ajax({
            url: 'scripts/php/loadStaff.php',
            type: 'post',
            success: function(response){
                $("#list").html(response);
                //alert(response);
                //document.getElementById("list").innerHTML(response);
            }
        });
    });
</script>

</body>
</html>
