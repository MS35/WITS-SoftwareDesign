<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 11 Oct 2018
 * Time: 05:46
 */
include "DeadlineSetter.php";
session_start();
$new_date = $_POST["cut_off_date"];
echo $new_date;
$new_time = $_POST["cut_off_time"];
echo $new_time;
$new_setter_id = $_SESSION["user_id"];
echo $new_setter_id;

$dls = new DeadlineSetter();
$dls->setDate($new_date);
$dls->setTime($new_time);
$dls->assignSetterId($new_setter_id);

header("Location:SetCutOffDateTime.html");