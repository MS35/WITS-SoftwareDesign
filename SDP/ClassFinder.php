<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 23 Nov 2018
 * Time: 01:06
 */

include_once("DBConnector.php");

class ClassFinder
{
    private $classes;
    private $db_name;

    public function __construct()
    {
        $this->classes =[];
        $this->db_name = "venue_allocations_db";
    }

    private function fetchClasses($course_code)
    {
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getClassesSQL = "SELECT class_id, diagonal ";
        $getClassesSQL .= "FROM classes ";
        $getClassesSQL .= "WHERE course_code='".$course_code."'";

        if($getClassesSQLResponse = mysqli_query($connection, $getClassesSQL)) {

            while($row=mysqli_fetch_row($getClassesSQLResponse)){
                $details = [];
                array_push($details,$row[0]);
                array_push($details,$row[1]);
                array_push($this->classes,$details);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);

    }

    public function makeClassesHTML($course_code){
        $this->fetchClasses($course_code);

        $outputHTML = "<select class='form-dropdown' id='classes' name='class' required>";
        $outputHTML .= "<option value='' selected disabled>-Please select a class-</option>";

        for($i = 0; $i < count($this->classes); $i++){
            $outputHTML .= "<option value='".$this->classes[$i][0]."'>";
            $outputHTML .= $this->classes[$i][0]." - ";
            $outputHTML .= $this->classes[$i][1];
            if($this->classes[$i][1] !== "GEN"){
                $outputHTML .= " diagonal";
            }
            $outputHTML .= "</option>";
        }

        $outputHTML .= "<option value='addNew'>ADD A NEW CLASS</option>";


        $outputHTML .= "</select>";

        return $outputHTML;
    }
}