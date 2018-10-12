<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 11 Oct 2018
 * Time: 03:33
 */

include "DeadlineSetter.php";

$dls = new DeadlineSetter();
echo $dls->getDate(),"+",$dls->getTime(),"+",$dls->getSetterId(),"\n";
$dls->setDate(date("Y/m/d"));
$dls->setTime(date("h:i:sa"));
$dls->assignSetterId("my_id");
echo $dls->getDate(),"+",$dls->getTime(),"+",$dls->getSetterId(),"\n";