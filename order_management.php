<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 12.01.2019
 * Time: 14:52
 */
include('scripts/php/DataBase.php');
$db = new DataBase();
if(isset($_SESSION['login']) && $db->checkChefPrivileges($_SESSION['login'])){
    $db->close();
    header('Location: '.'staff.php');
    exit();
}
else{
    $db->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Management</title>
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
            <div id="list" class="col-12"></div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>

    $(document).ready(function(){
        print();
        setInterval(function() {
            print();
        }, 1000);
    });

    function print() {
        $.ajax({
            url: 'scripts/php/printOrders.php',
            type: 'post',
            success: function (response) {
                $("#list").html(response);
                $(".rmfromorders").click(function(){
                    var scroll = $(window).scrollTop();
                    event.preventDefault();
                    $.ajax({
                        url: 'scripts/php/removeFromOrders.php',
                        type: 'post',
                        data: {"order_id": $(this).attr("id")},
                        success: function(response){
                            print();
                            $("html").scrollTop(scroll);
                        }
                    });
                });
            }
        });
    }
</script>

</body>
</html>

