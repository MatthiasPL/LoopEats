<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 07.01.2019
 * Time: 17:26
 */
session_start();
session_destroy();

header("Location: ../../index.php");
die();