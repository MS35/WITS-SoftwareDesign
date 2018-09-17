<?php
namespace MS35\WitsSoftwareDesign;
include 'connect.php';

/* Select queries return a resultset */
        class access{
            public function accessBad($value){
                //$args = func_get_args();
                //return $args[0];
                    if($value=="success"){
                        return 'success';
                    }
                    else if($value=="failed"){
                            return 'failed';
                    }
            }
        }
        $con = new connect();//this is the class with the server connection details, so here you are writing the
        $output = array();
        //$row = array();
        $success="";
        if (isset($_POST['submit'])) {
            $userid = $_POST["username"];
            $password = $_POST["password"];
            if ($result = mysqli_query($con->connectDetail(), "SELECT * from users where user_id='$userid'")) {
                while ($row = $result->fetch_assoc()) {
                    $output[] = $row;//each json object is taken as a row in php
                }
                if (mysqli_num_rows($result)) {
                    if ($output[0]["user_role"] == "LECTURER") {
                        include 'Navigate.html';
                        $success = "success";
                        $acc = new access();
                        $acc->accessGood($success);
                    }
                    if ($output[0]["user_role"] == "STUDENT") {
                        //include 'Create.html';
                        echo "student";
                        $success = "success";
                        $acc = new access();
                        $acc->accessGood($success);
                    }
                    if ($output[0]["user_role"] == "PIMD") {
                        echo "PIMD";
                        $success = "success";
                        $acc = new access();
                        $acc->accessGood($success);
                    }
                } else {
                    include 'Login.html';
                    $failed = "failed";
                    $acc = new access();
                    $acc->accessBad($failed);
                }
            }
        } else {
            $failed = "failed";
            $acc = new access();
            $acc->accessBad($failed);
            //return $failed;
            die();
        }
        $con->closeConnection();
