<?php

include_once("ClassAdder.php");

$course_code= $_POST['course_code'];
$diagonal = $_POST['diagonal'];
$lecturer_id = $_POST['lecturer'];
$adder = new ClassAdder($course_code,$lecturer_id,$diagonal);
$result = $adder->addClass();

if($result){
    header("Location: pickClass.html");
    exit();
}else{
    echo "Sorry\n";
    echo "variables:\nDiagonal= ".$diagonal.' Lecturer ID= '.$lecturer_id.' Course_Code= '.$course_code.'\n';
    print_r($_POST);
}