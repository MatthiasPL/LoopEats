<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 10.01.2019
 * Time: 15:10
 */
session_start();
if(isset($_SESSION["cart"])){
    unset($_SESSION["cart"]);
}