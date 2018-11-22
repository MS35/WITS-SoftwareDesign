<?php
    include_once('../file/DBConnector.php');

    $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();


        do{
            $useDBresult = mysqli_select_db($connection,"venue_allocations_db");
        }while(!$useDBresult);
        
        $getCourseCodes  = "SELECT course_code, course_name FROM courses";
        //$getCourseCodes .= "ORDER BY course_code ASC";
        
        $option = '<option disabled selected value> -- Select a course --</option>';

        

        if($getBookingsSQLResponse = mysqli_query($connection, $getCourseCodes)) {
            // output data of each row


            while($row = mysqli_fetch_row($getBookingsSQLResponse)){
                    $option .= '<option value = "'.$row[0].'">'.$row[0].' - '.$row[1].'</option>';
            }
        }

        echo $option;

?>