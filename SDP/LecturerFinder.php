<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 23 Nov 2018
 * Time: 01:06
 */

include_once("DBConnector.php");

class LecturerFinder
{
    private $lecturers;
    private $db_name;

    public function __construct()
    {
        $this->lecturers =[];
        $this->db_name = "venue_allocations_db";
    }

    private function fetchLecturers()
    {
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getLecturersSQL = "SELECT user_id, user_title, user_lname, user_fname ";
        $getLecturersSQL .= "FROM users ";
        $getLecturersSQL .= "WHERE user_role = 'LECTURER'";

        if($getLecturersSQLResponse = mysqli_query($connection, $getLecturersSQL)) {

            while($row=mysqli_fetch_row($getLecturersSQLResponse)){
                $details = [];
                array_push($details,$row[0]);
                array_push($details,$row[1]);
                array_push($details,$row[3]);
                array_push($details,$row[2]);
                array_push($this->lecturers,$details);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);

    }

    public function makeLecturersHTML(){
        $this->fetchLecturers();

        $outputHTML = "<datalist class='form-dropdown' id='lecturersList'>";

        for($i = 0; $i < count($this->lecturers); $i++){
            $outputHTML .= "<option value='".$this->lecturers[$i][0]."'>";
            $outputHTML .= $this->lecturers[$i][1]." ";
            $outputHTML .= $this->lecturers[$i][2]." ";
            $outputHTML .= $this->lecturers[$i][3]."</option>";
        }

        $outputHTML .= "</datalist>";

        return $outputHTML;
    }
}