<?php
//include_once ('DBConnector.php');
class CourseFeasiable
{
    public function insertVenue($requestID,$bookingID,$size,$con1){
    //$con1 = new connect();
    if ($res2 = mysqli_query($con1->connectDetail(), "INSERT INTO venue_requests(request_id,booking_id,class_size) values('$requestID','$bookingID','$size')")) {
        //get
        echo "inserted into venue_requests\n";
    }
    if (!empty(['equip'])) {
        foreach ($_POST['equip'] as $equip) {
            if ($equip == 'screen') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET screens=1 where request_id='$requestID'")){}
            } else if ($equip == 'speaker') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET speakers=1 where request_id='$requestID'")) {}
            }
            else if ($equip == 'ohp') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET overhead_projector=1 where request_id='$requestID'")) {}
            } else if ($equip == 'doc_camera') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET document_camera=1 where request_id='$requestID'")) {}
            } else if ($equip == 'hdmi') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET hdmi_cables=1 where request_id='$requestID'")) {}
            } else if ($equip == 'vga') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET vga_cables=1 where request_id='$requestID'")) {}
            } else if ($equip == 'projector') {
                if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET data_projector=1 where request_id='$requestID'")) {}
            }
        }
    }
}
    public  function submit(){
    include_once ('connect.php');
    //include_once ('../jquery3.js');
        $dsn = 'mysql:dbname=masi;host=127.0.0.1';
        $user = 'venues_db_user';
        $password = 'venues!@#';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();exit;
        }
    if (isset($_POST['submit']))
    {
    $userid = $_SESSION['user_id'];
        //$con = new DBConnector();//hlonis db connector
    $con1 = new connect();
        //course code
    $classSize = array();
        //this checks if  all the essential values in html file are set
    if (isset($_POST['instruction']) && isset($_POST['length_of_course']) && isset($_POST['weekday']) && isset($_POST['class_size']))
    {
        //randomizing booking id
    $bookingID = mt_rand(0, 999999999);

        //session classID
        //$classID = $_SESSION['classID'];
        //randomizing request id
    $classID = '5';
    $requestID = mt_rand(0, 99999999);

    $weekday = $_POST['weekday'];
    $act = $_POST['instruction'];
    $len = $_POST['length_of_course'];
    echo $len;
    $period0 = '';
    $startTime = "";
    $endTime = "";
    $user = '1312548';
    $size = $_POST['class_size'];
        //select from venues
    if ($result = mysqli_query($con1->connectDetail(), "SELECT * from venues where venue_size >= '$size'"))
    {
    while ($row = $result->fetch_assoc())
    {
    $classSize[] = $row;//each json object is taken as a row in php
    }
    }

    //checking if venues that size exist
    if (mysqli_num_rows($result)) {
        //inserting into bookings
        echo "something\n";
        //if ($res1 = mysqli_query($con1->connectDetail(), "INSERT into bookings values ('$bookingID','$user','$classID','$act','$len')")) {
            //get
            //echo "inserted\n";
            //insertVenue($requestID, $bookingID, $size,$con1);
        //}
        //inserting into venue_requests table

        $insert1 = $dbh->prepare("INSERT into bookings values (:one ,:two,:three,:four,:five)");
        $insert2 = $dbh->prepare("INSERT INTO venue_requests(request_id,booking_id,class_size) values(:six,:seven,:eight)");
        $insert3 = $dbh->prepare("INSERT INTO slots values (:nine,:ten,:eleven,:twelve)");
        //$insert['four']
        $dbh->beginTransaction();
        $insert1->bindValue(':one', $bookingID);
        $insert1->bindValue(':two', $user);
        $insert1->bindValue(':three', $classID);
        $insert1->bindValue(':four', $act);
        $insert1->bindValue(':five', $len);
        $insert1->execute();

        $insert2->bindValue(':six', $requestID);
        $insert2->bindValue(':seven', $bookingID);
        $insert2->bindValue(':eight', $size);
        $insert2->execute();

        //if ($res2 = mysqli_query($con1->connectDetail(), "INSERT INTO venue_requests(request_id,booking_id,class_size) values('$requestID','$bookingID','$size')")) {
            //get
            //echo "inserted into venue_requests\n";
        //}
        //now for inserting into the slot table
        foreach ($_POST['period'] as $period1) {
            $period0 = $period1;
        }
        //randomizing slot number
        $slotNum = mt_rand(0, 999999999);
        //checking the period number to see the size of the slot
        if ($period0 == 1) {
            $startTime = "08:00";
            $endTime = "08:45";
        } elseif ($period0 == 2) {
            $startTime = "09:00";
            $endTime = "09:45";
        } elseif ($period0 == 3) {
            $startTime = "10:15";
            $endTime = "11:00";
        } elseif ($period0 == 4) {
            $startTime = "11:15";
            $endTime = "12:00";
        } elseif ($period0 == 5) {
            $startTime = "12:30";
            $endTime = "13:15";
        } elseif ($period0 == 6) {
            $startTime = "14:15";
            $endTime = "15:00";
        } elseif ($period0 == 7) {
            $startTime = "15:15";
            $endTime = "16:00";
        } elseif ($period0 == 8) {
            $startTime = "16:15";
            $endTime = "17:00";
        }
        //inserting into slots table in masi db
        //if ($res3 = mysqli_query($con1->connectDetail(), "INSERT INTO slots values ('$slotNum','$startTime','$endTime','$weekday')")) {
            //get
        //}
        //$insert['three']->bindParam(':nine', $slotNum);
        //$insert['three']->bindParam(':ten', $startTime);
        //$insert['three']->bindParam(':eleven', $endTime);
        //$insert['three']->bindParam(':twelve', $weekday);
        //inserting into slot_requests
        //if ($res4 = mysqli_query($con1->connectDetail(), "INSERT INTO slot_requests values('$requestID','$slotNum') ")) {
            //get
        //}
        $dbh->commit();
        if (!empty(['equip'])) {
            foreach ($_POST['equip'] as $equip) {
                if ($equip == 'screen') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET screens=1 where request_id='$requestID'")){}
                } else if ($equip == 'speaker') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET speakers=1 where request_id='$requestID'")) {}
                }
                else if ($equip == 'ohp') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET overhead_projector=1 where request_id='$requestID'")) {}
                } else if ($equip == 'doc_camera') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET document_camera=1 where request_id='$requestID'")) {}
                } else if ($equip == 'hdmi') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET hdmi_cables=1 where request_id='$requestID'")) {}
                } else if ($equip == 'vga') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET vga_cables=1 where request_id='$requestID'")) {}
                } else if ($equip == 'projector') {
                    if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET data_projector=1 where request_id='$requestID'")) {}
                }
            }
        }
        //header("Location:Navigate.html");
        //exit();
    } else {
        $con1->closeConnection();
        echo "There is no venue that meets that size requirement\n";
    }
    } else {
        echo "You did not fill in one of the entries. \n";
        //header("Location:index.php");
        //exit();
    }
    }
    }
}
$obj = new CourseFeasiable();
$obj->submit();