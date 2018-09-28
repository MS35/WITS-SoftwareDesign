<?php
namespace MS35\WitsSoftwareDesign;
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
                session_start();
                $ip = new ip();
                $ipString = $ip->getRealIPAddr();
                //this shows the ip address
                //this gets the userid from the html form
                $userid = $_POST["username"];
                //this gets the password from the html form
                $password = $_POST["password"];
                //this is the class with the server connection details, so here you are writing the
                $con = new connect();
                //this array is going to take in the output from th database
                $userID = array();
                $userInfo = array();
                $success="";
                if (isset($_POST['submit'])) {
                    if ($result = mysqli_query($con->connectDetail(), "SELECT * from user_access where user_id='$userid' and password='$password'")) {
                        while ($row = $result->fetch_assoc()) {
                            $userID[] = $row;//each json object is taken as a row in php
                        }
                        if (mysqli_num_rows($result)) {
                            if($val = mysqli_query($con->connectDetail(),"SELECT * from users where user_id='$userid'")){
                                while($useInf = $val->fetch_assoc()) {
                                    $userInfo[] = $useInf;
                                }
                            }
                            $_SESSION["user_id"]=$userid;
                            $_SESSION["user_role"]=$userInfo[0]["user_role"];    
                            if(mysqli_num_rows($val)){
                                $atbl = new AttemptBlocker();
                                if ($atbl->confirmIPAddress($ipString) == 1) {
                                    echo "Access denied for 2 minutes";
                                } else if ($atbl->confirmIPAddress($ipString) == 0) {
                                    $atbl->clearLoginAttempts($ipString);
                                    if ($userInfo[0]["user_role"] == "LECTURER") {
                                        //this takes you to the navigate html page
                                        $success = "success";
                                        //this is from the class access
                                        $acc = new lectAcce();
                                        $acc->accessGood($success);
                                        header("Location:academicNavigate.html");
                                        exit();
                                    }
                                    if ($userInfo[0]["user_role"] == "STUDENT") {
                                        //include 'Create.html';
                                        echo "student";
                                        $success = "success";
                                        $acc = new lectAcce();
                                        $acc->accessGood($success);
                                    }
                                    if ($userInfo[0]["user_role"] == "PIMD") {
                                        echo "PIMD";
                                        $success = "success";
                                        $acc = new lectAcce();
                                        $acc->accessGood($success);
                                        header("Location:pimdNavigate.html");
                                        exit();
                                    }
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
                            $acc = new access();
                            $acc->accessBad($failed);
                        }
                    }
                } else {

                    $failed = "failed";
                    $acc = new access();
                    $acc->accessBad($failed);
                }
                $con->closeConnection();
            }
        }
        //object from
        $lect = new access();
        $lect->lec();
?>
