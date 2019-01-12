<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 07.01.2019
 * Time: 17:26
 */
session_start();
unset($_SESSION['login']);

header("Location: ../../index.php");
die();