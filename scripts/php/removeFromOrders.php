<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 12.01.2019
 * Time: 17:01
 */
include('DataBase.php');
session_start();

$db = new DataBase();

if(isset($_SESSION['login']) && $db->checkChefPrivileges($_SESSION['login']) && isset($_POST['order_id'])){
    $fp = fopen('orders/lock', 'r+');

    if($lock = flock($fp, LOCK_EX)) {
        $inp = file_get_contents('orders/orders.json');
        $tempArray = json_decode($inp, TRUE);

        $arr_index = array();
        foreach ($tempArray as $key => $value) {
            if ($value['id'] == $_POST['order_id']) {
                $arr_index[] = $key;
            }
        }

        foreach ($arr_index as $i) {
            unset($tempArray[$i]);
        }

        $json = json_encode($tempArray, JSON_PRETTY_PRINT);
        file_put_contents('orders/orders.json', $json);
    }

    flock($fp, LOCK_UN);
    fclose($fp);
}

$db->close();