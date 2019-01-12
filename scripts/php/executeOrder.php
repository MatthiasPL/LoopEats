<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 12.01.2019
 * Time: 11:55
 */

include('DataBase.php');
session_start();

if(isset($_POST['surname']) && isset($_POST['numPeople']) && isset($_POST['time']) && isset($_POST['takeaway']) && count($_SESSION['cart'])){
    $inp = file_get_contents('orders/orders.json');
    $tempArray = json_decode($inp, TRUE);
    $db = new DataBase();

    $nmAtHour = 0; //number of orders at specified time

    foreach ($tempArray as $person){
        if($person['time']==$_POST['time']){
            $nmAtHour++;
        }
    }

    //echo $nmAtHour;
    $id = 0;
    while ($productQuantity = key($_SESSION['cart'])) {
        $times[$id] = intval($db->returnDishTime(key($_SESSION['cart'])));
        //echo $db->intval(returnDishTime(key($_SESSION['cart'])));
        next($_SESSION['cart']);
        $id++;
    }

    $maxtime = max($times);

    if($nmAtHour<=10){

        $time = date("G:i:s");
        $time1 = strtotime($time);
        $time2 = strtotime(date($_POST['time']))+$maxtime*60;

        if($time1<$time2){
            $id = 0;
            $overallPrice=0;
            while ($productQuantity = key($_SESSION['cart'])) {
                $products[$id]['id'] = key($_SESSION['cart']);
                $products[$id]['quantity'] = $productQuantity;
                $overallPrice += $productQuantity * $db->returnDishPrice(key($_SESSION['cart']));
                next($_SESSION['cart']);
                $id++;
            }

            $tempArray[$_POST['surname']]=[
                'time' => $_POST['time'],
                'num_people' => intval($_POST['numPeople']),
                'products' => $products,
                'takeaway' => doubleval($_POST['takeaway']),
                'price' => $overallPrice
            ];

            $json = json_encode($tempArray, JSON_PRETTY_PRINT);
            file_put_contents('orders/orders.json', $json);
            echo "Successfully ordered";
        }
        else{
            $time = date('G:i');
            $time2 = date('G:i', $maxtime * 60);
            echo "Please select a different hour. It's {$time} and you selected {$_POST['time']}. The preparation of the food would take {$time2} hour(s).";
        }
    }
    else{
        echo "Too many orders at ".$_POST['time'].". Try different time.";
    }
    $db->close();
}
