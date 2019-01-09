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
    <div class="row justify-content-center">
        <button type="button" id="add-dish" class="btn btn-success">Add new dish</button>
    </div>
    <div class="row h-100 justify-content-center" id="add-dish-card">
        <div class="col-sm-12 col-md-4 align-items-stretch">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title"><strong>Add new dish</strong></div>
                    <form role="form" id="menu-form">
                        Name: <input type="text" id="dish_name" class="input-group-text w-100" required />
                        Description: <input type="text" id="dish_description" class="input-group-text w-100" required />
                        Price: <input type="number" id="price" class="input-group-text w-100" min="0.00" max="10000.00" step="0.01" required />
                        Image (link): <input type="url" id="image" class="input-group-text w-100"" />
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
                            <input type="checkbox" class="custom-control-input" id="contains_nuts">
                            <label class="custom-control-label" for="contains_nuts">Contains nuts</label>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success w-100" id="add-to-menu">Add</button>
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
        $("#add-dish-card").hide();
        $.ajax({
            url: 'scripts/php/loadMenu.php',
            type: 'post',
            success: function (response) {
                $("#list").html(response);
                $(".rmdish").click(function(){
                    if (confirm('Are you sure to remove this dish from the menu?')) {
                        $.ajax({
                            url: 'scripts/php/removeFromMenu.php',
                            type: 'post',
                            data: {"dish_id": $(this).parent().attr("id")},
                            success: function(response){
                                location.reload();
                            }
                        });
                    }
                });
            }
        });
    });

    $("#add-dish").click(function () {
        if($(this).html()=="Add new dish"){
            $("#add-dish-card").show(600);
            $(this).html("Hide");
        }else{
            $("#add-dish-card").hide(600);
            $(this).html("Add new dish");
        }
    });

    $("#menu-form").submit(function(){
        event.preventDefault();

        var veganfriendly = $("#vegan_friendly").is(':checked');
        var glutenfree = $("#gluten_free").is(':checked');
        var spicy = $("#spicy").is(':checked');
        var contains_nuts = $("#contains_nuts").is(':checked');

        if(veganfriendly===true){
            veganfriendly="1";
        }
        else{
            veganfriendly="0";
        }
        if(glutenfree===true){
            glutenfree="1";
        }
        else {
            glutenfree="0";
        }
        if(spicy===true){
            spicy="1";
        }
        else{
            spicy="0";
        }
        if(contains_nuts===true){
            contains_nuts="1";
        }
        else {
            contains_nuts="0";
        }
        //if()
        $.ajax({
            url: 'scripts/php/addToMenu.php',
            type: 'post',
            //if(isset($_SESSION['login']) && isset($_POST['dish_name']) && isset($_POST['dish_description']) && isset($_POST['price']) && isset($_POST['vegan_friendly']) && isset($_POST['gluten_free']) && isset($_POST['spicy']) && isset($_POST["contains_nuts"])){
            data: {"dish_name": $("#dish_name").val(), "dish_description": $("#dish_description").val(), "price": $("#price").val(), "vegan_friendly": veganfriendly, "gluten_free": glutenfree, "spicy": spicy, "contains_nuts": contains_nuts},
            success: function(response){
                alert(response);
                location.reload();
            }
        });
    });
</script>