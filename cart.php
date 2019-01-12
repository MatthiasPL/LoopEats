<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 10.01.2019
 * Time: 11:21
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<?php include "parts/navbar.php"?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="btn-link float-right" id="emptyCart" href="#">Empty Cart</a>
        </div>
        <div class="col-12">
            <div id="list" class="col-12"></div>
        </div>
    </div>
    <?php
    if(count($_SESSION['cart'])){
        echo"<div class=\"row justify-content-center\">";
        echo"<a href=\"orderfinish.php\" id=\"next-step\" class=\"btn btn-success\">Next</a>";
        echo "</div>";
    }
    ?>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $( document ).ready(function() {
        print();
    });
    $("#emptyCart").click(function(){
        event.preventDefault();
        if (confirm('Are you sure to empty your cart?')) {
            $.ajax({
                url: 'scripts/php/emptyCart.php',
                type: 'post',
                success: function (response) {
                    //$("#list").html(response);
                    //print();
                    location.reload();
                }
            });
        }
    });
    function print(){
        $.ajax({
            url: 'scripts/php/printCart.php',
            type: 'post',
            success: function (response) {
                $("#list").html(response);
                $(".rmfromcart").click(function () {
                    if (confirm('Are you sure to remove this dish from the order?')) {
                        $.ajax({
                            url: 'scripts/php/removeItemFromCart.php',
                            type: 'post',
                            data: {"dish_id": $(this).attr("id")},
                            success: function (response) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        });
    }

    /*$("#next-step").click(function () {
       alert("next");
    });*/
</script>
</body>
</html>
