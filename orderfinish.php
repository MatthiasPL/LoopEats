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
    <title>Order</title>
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
                            <label for="time">Time: <i class="text-black-50">(12-20:30 every 0.5h)</i></label>
                            <!--<input type="time" class="form-control" id="time" min="12:00" max="20:00" step="1800" required>-->
                            <select id="time">
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <input type="text" class="form-control" id="comment" maxlength="32">
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

    $("#order-form").submit(function(event){
        event.preventDefault();

        var takeaway = $("#takeaway").is(':checked');

        if(takeaway===true){
            takeaway="1";
        }
        else{
            takeaway="0";
        }

        var value = $("#time option:selected").val();

        $.ajax({
            url: 'scripts/php/executeOrder.php',
            type: 'post',
            data: {"surname": $("#surname").val(), "numPeople": $("#num-people").val(), "time": value, "takeaway": takeaway, "comment": $("#comment").val()},
            success: function (response) {
                if(response=="Successfully ordered"){
                    $("#successmessage").text(response);
                    $("#success-alert").slideDown(1500).delay(1000).slideUp(1500, function(event){
                        event.preventDefault();
                        $("#error-alert").fadeOut(1000, function(event){

                        });
                    });
                    setTimeout(
                        function()
                        {
                            $.ajax({
                                url: 'scripts/php/emptyCart.php',
                                type: 'post',
                                success: function (response) {
                                    window.location.replace("order.php");
                                }
                            });
                        }, 3500);
                    $('#order-form')[0].reset();
                }
                else{
                    $("#errormessage").text(response);
                    $("#error-alert").slideDown(1500).delay(2000).slideUp(1500, function(event){
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
