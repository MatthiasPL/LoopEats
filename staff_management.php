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
        <button type="button" id="add-person" class="btn btn-success">Add new person</button>
    </div>
    <div class="row h-100 justify-content-center" id="add-person-card">
        <div class="col-sm-12 col-md-4 align-items-stretch">
            <div class="card h-100">
                <div class="card-body">
                    <form role="form" id="staff_form">
                        <div class="card-title"><strong>Add new person</strong></div>
                        Login: <input type="text" id="login" class="input-group-text w-100" required/>
                        Password: <input type="password" id="password" class="input-group-text w-100" required/>
                        Name: <input type="text" id="name" class="input-group-text w-100" required/>
                        Surname: <input type="text" id="surname" class="input-group-text w-100" required/>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ischef">
                            <label class="custom-control-label" for="ischef">Is chef</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ismanager">
                            <label class="custom-control-label" for="ismanager">Is manager</label>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success w-100" id="add-to-staff">Add</button>
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
        $("#add-person-card").hide();
        $.ajax({
            url: 'scripts/php/loadStaff.php',
            type: 'post',
            success: function(response){
                $("#list").html(response);
                $(".rmstaff").click(function(){
                    if (confirm('Are you sure to remove this person from the staff?')) {
                        $.ajax({
                            url: 'scripts/php/removeFromStaff.php',
                            type: 'post',
                            data: {"staff_id": $(this).parent().attr("id")},
                            success: function(response){
                                location.reload();
                            }
                        });
                    }
                });
                $(".manager").click(function(){
                    $.ajax({
                        url: 'scripts/php/changeManagerPrivileges.php',
                        type: 'post',
                        data: {"login": $(this).parent().attr("id")},
                        success: function(response){
                            location.reload();
                        }
                    });
                });
                $(".chef").click(function(){
                    $.ajax({
                        url: 'scripts/php/changeChefPrivileges.php',
                        type: 'post',
                        data: {"login": $(this).parent().attr("id")},
                        success: function(response){
                            location.reload();
                        }
                    });
                });
            }
        });
    });
    $("#add-person").click(function () {
        if($(this).html()=="Add new person"){
            $("#add-person-card").show(600);
            $(this).html("Hide");
        }else{
            $("#add-person-card").hide(600);
            $(this).html("Add new person");
        }
    });
    $("#staff_form").submit(function (){
        var ismanager = $("#ismanager").is(':checked');
        var ischef = $("#ischef").is(':checked');
        if(ismanager===true){
            ismanager="1";
        }
        else{
            ismanager="0";
        }
        if(ischef===true){
            ischef="1";
        }
        else {
            ischef="0";
        }
        //alert(ischef);
        $.ajax({
            url: 'scripts/php/addToStaff.php',
            type: 'post',
            data: {"login": $("#login").val(), "password": $("#password").val(), "name": $("#name").val(), "surname": $("#surname").val(), "ischef": ischef, "ismanager": ismanager},
            success: function(response){
                location.reload();
            }
        });
    });
</script>

</body>
</html>
