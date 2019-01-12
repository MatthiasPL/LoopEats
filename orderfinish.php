<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 11.01.2019
 * Time: 11:52
 */
session_start();
if(!count($_SESSION['cart'])){
    header('Location: '.'index.php');
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
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <div id="successmessage"></div>
    </div>
    <div class="alert alert-danger" id="error-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <div id="errormessage"></div>
    </div>
    <div class="row">
        <div class="col-sm-1 col-md-4"></div>
        <div class="col-sm-10 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><strong>Order</strong></div>
                    <form role="form" id="order-form">
                        <div class="form-group">
                            <label for="surname">Surname:</label>
                            <input type="text" class="form-control" id="surname" placeholder="Enter your surname" required>
                        </div>
                        <div class="form-group">
                            <label for="num-people">Number of people:</label>
                            <input type="number" step="1" min="1" max="6" class="form-control" id="num-people" placeholder="Enter number of people" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Time: <i class="text-black-50">(12-16 every 0.5h)</i></label>
                            <input type="time" class="form-control" id="time" min="12:00" max="20:00" step="1800" required>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="takeaway">
                            <label class="custom-control-label" for="takeaway">Takeaway</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="button-order" class="btn btn-primary">Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-1 col-md-4"></div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $("#success-alert").hide();
    $("#error-alert").hide();

    $("#order-form").submit(function(){
        event.preventDefault();

        var takeaway = $("#takeaway").is(':checked');

        if(takeaway===true){
            takeaway="1";
        }
        else{
            takeaway="0";
        }

        $.ajax({
            url: 'scripts/php/executeOrder.php',
            type: 'post',
            data: {"surname": $("#surname").val(), "numPeople": $("#num-people").val(), "time": $("#time").val(), "takeaway": takeaway},
            success: function (response) {
                if(response=="Successfully ordered"){
                    $("#successmessage").text(response);
                    $("#success-alert").slideDown(1500).delay(1000).slideUp(1500, function(){
                        $("#error-alert").fadeOut(1000, function(){
                            $.ajax({
                                url: 'scripts/php/emptyCart.php',
                                type: 'post',
                                success: function (response) {
                                    window.location.replace("order.php");
                                }
                            });
                        });
                    });
                    $('#order-form')[0].reset();
                }
                else{
                    $("#errormessage").text(response);
                    $("#error-alert").slideDown(1500).delay(2000).slideUp(1500, function(){
                        $("#error-alert").fadeOut(500);
                    });
                }
            },
            error: function(response){
                $("#errormessage").text("Couldn't execute the order");
            }
        });
    });
</script>

</body>
</html>
