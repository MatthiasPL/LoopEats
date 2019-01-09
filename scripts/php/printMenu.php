<?php
include('DataBase.php');
session_start();

    $db = new DataBase();
    $db->printMenu();
    $db->close();