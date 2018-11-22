/*
    By Motheo Sekgetho 23 November 2018
*/

<?php
    include_once('../file/DBConnector.php');

        $connector = new DBConnector();



        $course_code = $_POST['course'];

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();


        do{
            $useDBresult = mysqli_select_db($connection,"venue_allocations_db");
        }while(!$useDBresult);
        
        $getClassID  = "SELECT class_id FROM classes ";
        $getClassID .= "WHERE classes.course_code='".$course_code."'";
        
            $option = '<option disabled selected value = "">--Select a class ID--</option>';



        

        if($getClassIDResponse = mysqli_query($connection, $getClassID)) {
            // output data of each row

            echo '<p'.$course_code.'</p>';
            /*while($row = mysqli_fetch_row($getClassIDResponse)){
                    $option .= '<option value = "'.$row[0].'">'.$row[0]'</option>';
            }*/
        }

        echo $option;

?>
