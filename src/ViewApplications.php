<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 28 Sep 2018
 * Time: 07:20
 */

include "ApplicationViewer.php";

$viewer = new ApplicationViewer();
$user_id = $_SESSION["user_id"];
$user_role = $_SESSION["user_role"];

if($user_role==""){
    $table = $viewer->findApplicationsPIMD();
}else{
    $table = $viewer->findApplicationsUser($user_id);
}

echo $table;