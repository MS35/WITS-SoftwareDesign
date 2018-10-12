<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 11 Oct 2018
 * Time: 04:52
 */
include "DeadlineSetter.php";

$dls = new DeadlineSetter();
$curr_deadline_date = $dls->getDate();
$curr_deadline_time = $dls->getTime();

if($curr_deadline_date == "" && $curr_deadline_time == ""){
    echo "The deadline for booking venues has not been set yet.";
}else{
    echo "The current deadline for booking venues is on ",$curr_deadline_date," at ",$curr_deadline_time;
}