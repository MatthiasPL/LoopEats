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
<?php include "parts/navbar.php"?>
<div class="container">
    <div class="row justify-content-center">
        <button type="button" id="search-dish" class="btn btn-success">Search</button>
    </div>
    <div class="row h-100 justify-content-center" id="search-card">
        <div class="col-sm-12 col-md-4 align-items-stretch">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title"><strong>Add new dish</strong></div>
                    <form role="form" id="menu-form">
                        Name: <input type="text" id="dish_name" class="input-group-text w-100" />
                        Description: <input type="text" id="dish_description" class="input-group-text w-100" />
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="vegan_friendly">
                            <label class="custom-control-label" for="vegan_friendly">Vegan</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="gluten_free">
                            <label class="custom-control-label" for="gluten_free">Gluten free</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="spicy">
                            <label class="custom-control-label" for="spicy">Spicy</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="without_nuts">
                            <label class="custom-control-label" for="without_nuts">Without nuts</label>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success w-100" id="search-menu">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div id="list"></div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $( document ).ready(function() {
        $("#search-card").hide();
        draw();
    });

    $("#search-dish").click(function () {
        if($(this).html()=="Search"){
            $("#search-card").show(600);
            $(this).html("Hide");
        }else{
            $("#search-card").hide(600);
            $(this).html("Search");
        }
    });

    $("#search-menu").click(function(){

    });

    function draw() {
        $.ajax({
            url: 'scripts/php/printOrderMenu.php',
            type: 'post',
            success: function (response) {
                $("#list").html(response);
                $(".adddish").click(function(){
                    if($(this).parent().parent().find("#quantity").val()>0){
                        //alert($(this).parent().parent().parent().parent().attr("id"));
                        $.ajax({
                            url: 'scripts/php/addToCart.php',
                            type: 'post',
                            data: {"dish_id": $(this).parent().parent().parent().parent().attr("id"), "quantity": $(this).parent().parent().find("#quantity").val()},
                            success: function(response){
                                //alert(response);
                                location.reload();
                                //draw();
                            }
                        });
                    }
                });
                $(".rmdish").click(function(){
                    //alert($(this).parent().parent().parent().parent().attr("id"));
                    if (confirm('Are you sure to remove this dish from the order?')) {
                        $.ajax({
                            url: 'scripts/php/removeFromCart.php',
                            type: 'post',
                            data: {"dish_id": $(this).parent().parent().parent().parent().attr("id")},
                            success: function (response) {
                                //location.reload();
                                draw();
                            }
                        });
                    }
                });
            }
        });
    }
</script>
</body>
</html>
