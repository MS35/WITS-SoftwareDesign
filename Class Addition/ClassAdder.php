<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 21 Nov 2018
 * Time: 11:57
 */

include_once("DBConnector.php");
class ClassAdder
{
    private $course_code;
    private $lecturer_id;
    private $diagonal;
    private $db_name;

    public function __construct($course_code,$lecturer_id,$diagonal)
    {
        $this->course_code = $course_code;
        $this->diagonal = $diagonal;
        $this->lecturer_id = $lecturer_id;
        $this->db_name = "venue_allocations_db";
    }

    private function makeClassID()
    {
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getClassesSQL = "SELECT * FROM classes WHERE course_code = '".$this->course_code."'";

        $numClasses = 0;

        if($getClassesSQLResponse = mysqli_query($connection, $getClassesSQL)) {
            // output data of each row

            while($row=mysqli_fetch_row($getClassesSQLResponse)){
                $numClasses += 1;
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);

        $classID = $this->course_code."/".($numClasses + 1);
        return $classID;
    }

    public function addClass()
    {
        $classID = $this->makeClassID();

        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $addClassSQL = "INSERT INTO classes(course_code,lecturer_id,class_id,diagonal) ";
        $addClassSQL .= "VALUES ('".$this->course_code."','".$this->lecturer_id."','";
        $addClassSQL .= $classID."','".$this->diagonal."')";

        $success = null;

        if($addClassSQLResponse = mysqli_query($connection, $addClassSQL)) {
            $success = true;
        }else{
            $success = false;
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);

        return $success;
    }
}