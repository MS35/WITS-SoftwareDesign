<?php
//session_start();
include_once('connect.php');
if(isset($_POST['submit'])) {
    $con1 = new connect();
    $courseCode = $_POST['course'];
    $course = 'COMS1016';
//$userid = $_SESSION['user_id'];//taken from login session
//randomizing class id
    $classID = mt_rand(0, 999999999);
//$classID = 6;
//$_SESSION['classID'] = $classID;
//echo $classID;
    $dia = 'A';
    $user = '1312548';
    echo "clicked";
//insert into "classes" table in db
    if ($result = mysqli_query($con1->connectDetail(), "INSERT INTO classes values('$classID','$course','$user','$dia')")) {
        //do nothing
    }
    header("Location:../Menu/form.html");
    exit();
}