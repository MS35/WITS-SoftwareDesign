<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 23 Nov 2018
 * Time: 01:06
 */

include_once("DBConnector.php");

class CourseFinder
{
    private $courses;
    private $db_name;

    public function __construct()
    {
        $this->courses =[];
        $this->db_name = "venue_allocations_db";
    }

    private function fetchCourses()
    {
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getCoursesSQL = "SELECT course_code, course_name ";
        $getCoursesSQL .= "FROM courses";

        if($getCoursesSQLResponse = mysqli_query($connection, $getCoursesSQL)) {

            while($row=mysqli_fetch_row($getCoursesSQLResponse)){
                $details = [];
                array_push($details,$row[0]);
                array_push($details,$row[1]);
                array_push($this->courses,$details);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);

    }

    public function makeCoursesHTML(){
        $this->fetchCourses();

        $outputHTML = "<select class='form-dropdown' id='courses' name='course' required>";
        $outputHTML .= "<option value='' selected disabled>-Please select a course-</option>";

        for($i = 0; $i < count($this->courses); $i++){
            $outputHTML .= "<option value='".$this->courses[$i][0]."'>";
            $outputHTML .= $this->courses[$i][0]." - ";
            $outputHTML .= $this->courses[$i][1]."</option>";
        }

        $outputHTML .= "</select>";

        return $outputHTML;
    }
}