<?php
include_once('connect.php');
include_once('getIpAddress.php');
include_once('AttemptBlocker.php');
/* Select queries return a resultset */
        class access{
            public function accessGood(){
                $args = func_get_args();
                return $args[0];
            }
            public function accessBad(){
                $args = func_get_args();
                return $args[0];
            }

            /**
             *
             */
            public function lec(){
                $ip = new ip();
                $ipString = $ip->getRealIPAddr();
                //this shows the ip address
                //echo $ip->getRealIPAddr();
                //this gets the userid from the html form
                $userid = $_POST["username"];
                //this gets the password from the html form
                $password = $_POST["password"];
                //this is the class with the server connection details, so here you are writing the
                $con = new connect();
                //this array is going to take in the output from th database
                $output = array();
                //$row = array();
                $success="";
                if (isset($_POST['submit'])) {
                    if ($result = mysqli_query($con->connectDetail(), "SELECT * from users where user_id='$userid'")) {
                        while ($row = $result->fetch_assoc()) {
                            $output[] = $row;//each json object is taken as a row in php
                        }
                        if (mysqli_num_rows($result)) {
                            $atbl = new AttemptBlocker();
                            if ($atbl->confirmIPAddress($ipString) == 1) {
                                echo "Access denied for 2 minutes";
                            } else if ($atbl->confirmIPAddress($ipString) == 0) {
                                $atbl->clearLoginAttempts($ipString);
                                if ($output[0]["user_role"] == "LECTURER") {
                                    //this takes you to the navigate html page
                                    $success = "success";
                                    //this is from the class access
                                    $acc = new lectAcce();
                                    $acc->accessGood($success);
                                    header("Location:Navigate.html");
                                    exit();
                                }
                                if ($output[0]["user_role"] == "STUDENT") {
                                    //include 'Create.html';
                                    echo "student";
                                    $success = "success";
                                    $acc = new lectAcce();
                                    $acc->accessGood($success);
                                }
                                if ($output[0]["user_role"] == "PIMD") {
                                    echo "PIMD";
                                    $success = "success";
                                    $acc = new lectAcce();
                                    $acc->accessGood($success);
                                }
                            }
                        }
                        else {
                            $atbl = new AttemptBlocker();
                            if($atbl->confirmIPAddress($ipString)==1){
                                echo "Access denied for 2 minutes";
                            }else if($atbl->confirmIPAddress($ipString)==0){
                                echo "User name or password incorrect";
                                $atbl->addLoginAttempt($ipString);
                                header("Location:Login.html");
                                exit();
                            }
                            $failed = "failed";
                            $acc = new lectAcce();
                            $acc->accessBad($failed);
                        }
                    }
                } else {

                    $failed = "failed";
                    $acc = new lectAcce();
                    $acc->accessBad($failed);
                }
                $con->closeConnection();
            }
        }
        //object from
        $lect = new access();
        $lect->lec();
?>
