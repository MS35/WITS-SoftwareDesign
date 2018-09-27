<?php
    include_once('connect.php');
    include_once('getIpAddress.php');
    class AttemptBlocker
    {
        //this function checks if the ip exists in the database
        function confirmIPAddress($value)
        {
            $con = new connect();
            $q = "SELECT * from LoginAttempts WHERE IP = '$value'";
            $output = array();
            if($result = mysqli_query($con->connectDetail(),$q)) {
                if(mysqli_num_rows($result)) {
                    while ($row = $result->fetch_assoc()) {
                        $output[] = $row;//each json object is taken as a row in php
                    }
                    $time2 = $output[0]["LastLogin"];
                    //echo $time2."\n";
                    //echo date('i');
                    if ($output[0]["Attempts"] >= 3) {

                        if (abs(date('i.s') - date('i.s', strtotime($time2))) <= 2) {
                            return 1;
                        } else {
                            $this->clearLoginAttempts($value);
                            return 0;
                        }
                    }
                }else{
                    $this->addLoginAttempt($value);
                    $this->clearLoginAttempts($value);
                    return 0;
                }
            }
            return 0;
        }
        //this function adds a log in every time some from a different ip tries to log in
        function addLoginAttempt($value)
        {
            //Increase number of attempts. Set last login attempt if required.
            $con = new connect();
            $q = "SELECT * FROM LoginAttempts WHERE IP = '$value'";
            $result = mysqli_query($con->connectDetail(),$q);
            $data = mysqli_fetch_array($result);

            if ($data) {
                $attempts = $data["Attempts"] + 1;

                if ($attempts == 3) {
                    $q = "UPDATE LoginAttempts SET attempts=" . $attempts . ", LastLogin=NOW() WHERE ip = '$value'";
                    $result = mysqli_query($con->connectDetail(),$q);
                } else {
                    $q = "UPDATE LoginAttempts SET attempts=" . $attempts . " WHERE ip = '$value'";
                    $result = mysqli_query($con->connectDetail(),$q);
                }
            } else {
                $q = "INSERT INTO LoginAttempts (Attempts,IP,LastLogin) values (1, '$value', NOW())";
                $result = mysqli_query($con->connectDetail(),$q);
            }
        }

        function clearLoginAttempts($value)
        {
            $con = new connect();
            $q = "UPDATE LoginAttempts SET Attempts = 0 WHERE IP = '$value'";
            return$result = mysqli_query($con->connectDetail(),$q);
        }
    }
?>