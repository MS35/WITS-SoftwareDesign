<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 11 Oct 2018
 * Time: 05:55
 */
session_start();
$_SESSION["user_id"] = "123456789";
//echo $_SESSION["user_id"];

header("Location: SetCutOffDateTime.html");