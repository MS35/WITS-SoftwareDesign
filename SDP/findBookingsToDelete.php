<?php

include_once("DeleteBookingsViewer.php");
session_start();

$user_id = $_SESSION["user_id"];
$user_role = $_SESSION["user_role"];

$bookingViewer = new DeleteBookingsViewer();
$applications = '';
if($user_role == "LECTURER"){
    $applications = $bookingViewer->makeLecturersBookingsHTML($user_id);
}else if($user_role == "ADMIN"){
    $applications = $bookingViewer->makeAdminsBookingsHTML($user_id);
}else{
    $applications = $bookingViewer->makePIMDBookingsHTML();
}

echo $applications;