<?php
session_start();
$course_code = $_SESSION["course_code"];
if(!$course_code){
    $course_code = "NOPE";
}
$output = "<input type='text' id='courseCode' name='course_code' ";
$output .= "value='".$course_code."' readonly>";
echo $output;