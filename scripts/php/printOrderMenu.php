<?php
include('DataBase.php');
session_start();

    $db = new DataBase();
    $db->printOrderMenu();
    $db->close();