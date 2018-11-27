<?php

class CourseFeasableNew{
    public function feasable(){
        //session_start();
        $this->insertBookings();
        $this->insertVenueReq();
        $this->insertSlotsReq();
    }

    public function insertBookings(){
        include_once ('connect.php');
        session_start();
        $con1 = new connect();
        $act = $_POST['instruction'];
        $len = $_POST['length_of_course'];
        //this should be changed to a different thing
        $user = $_SESSION['user_id'];
        //$user = '1312548';
        $classID = $_SESSION["classApp1"];
        //$classID = 'COMS1015/1';
        echo $len;
        $_SESSION["courLength"] = $len;
        $insertBookingQue = "INSERT into bookings(booker_id, class_id, activity_type, active_year_period) values ('$user','$classID','$act','$len')";
        if ($res1 = mysqli_query($con1->connectDetail(),$insertBookingQue )) {
            //$this->nextButton();
            echo "Bookings insert\n";
        }else {
            echo "Error: " . $insertBookingQue . "<br>" . mysqli_error($con1);
        }
    }

    public function insertVenueReq(){
        include_once ('connect.php');
        $con1 = new connect();
        $size = $_POST['class_size'];
        $sizeArrBook = 0;
        $book = array();
        $selectVenueQue = "SELECT * from venues where venue_size >= '$size'";
        if ($result = mysqli_query($con1->connectDetail(),$selectVenueQue ))
        {
            while ($row = $result->fetch_assoc())
            {
            }
            echo "Venues select. \n";
        }

        //checking if venues that size exist
        if (mysqli_num_rows($result)) {
            $selectBookQue = "select * from bookings";
            if ($res2 = mysqli_query($con1->connectDetail(), $selectBookQue)) {
                while ($row = $res2->fetch_assoc())
                {
                    $book[] = $row;//each json object is taken as a row in php
                }
                $sizeArrBook = sizeof($book);
                echo "Bookings select";
            }else {
                echo "Error: " . $selectBookQue . "<br>" . mysqli_error($con1);
            }
            echo $sizeArrBook.("\n");
            $sizeArrBook = $sizeArrBook - 1;
            $bookInt = $book[$sizeArrBook]["booking_id"];
            $bookInt = (int)$bookInt;
            //echo $bookInt.("\n");
            $insertVenueReqQue = "INSERT INTO venue_requests(booking_id,class_size,data_projector,overhead_projector,screens,sound,speakers,hdmi_cables,vga_cables,document_camera) values (\"".$bookInt."\",'$size',0,0,0,0,0,0,0,0)";
            if(mysqli_query($con1->connectDetail(),$insertVenueReqQue)){
                echo "Insert venue_requests. \n";
            } else {
                echo "Error: " . $insertVenueReqQue . "<br>" . mysqli_error($con1);
            }

            if (!empty($_POST['equip'])) {
                foreach ($_POST['equip'] as $equip) {
                    if ($equip == 'screen') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET screens=1 where booking_id='$bookInt'")){}
                    } else if ($equip == 'speaker') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET speakers=1 where booking_id='$bookInt'")) {}
                    }
                    else if ($equip == 'ohp') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET overhead_projector=1 where booking_id='$bookInt'")) {}
                    } else if ($equip == 'doc_camera') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET document_camera=1 where booking_id='$bookInt'")) {}
                    } else if ($equip == 'hdmi') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET hdmi_cables=1 where booking_id='$bookInt'")) {}
                    } else if ($equip == 'vga') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET vga_cables=1 where booking_id='$bookInt'")) {}
                    } else if ($equip == 'projector') {
                        if ($eqp = mysqli_query($con1->connectDetail(), "UPDATE venue_requests SET data_projector=1 where booking_id='$bookInt'")) {}
                    }
                }
            }
        }
    }

    public function insertSlotsReq(){
        include_once ('connect.php');
        $con1 = new connect();
        $requests = array();
        $sizeArrReque = 0;
        $period0 = 0;
        $weekday = $_POST['weekday'];

        $selectVenueReqQue = "select * from venue_requests";
        if ($res2 = mysqli_query($con1->connectDetail(), $selectVenueReqQue)) {
            while ($row = $res2->fetch_assoc())
            {
                $requests[] = $row;//each json object is taken as a row in php
            }
            $sizeArrReque = sizeof($requests);
            echo "Venue_requests select";
        }else {
            echo "Error: " . $selectVenueReqQue . "<br>" . mysqli_error($con1);
        }
        $sizeArrReque = $sizeArrReque - 1;
        $requestID = $requests[$sizeArrReque]["request_id"];
        foreach ($_POST['period'] as $period1) {
            $period0 = $period1;
        }
        //checking the period number to see the size of the slot
        if($weekday=="Monday"){
            $period0 = 0 + $period0;
        }else if($weekday=="Tuesday"){
            $period0 = 8 + $period0;
        }else if($weekday=="Wednesday"){
            $period0 = 16 + $period0;
        }else if($weekday=="Thursday"){
            $period0 = 24 + $period0;
        }else if($weekday=="Friday"){
            $period0 = 32 + $period0;
        }
        $insertSlotsQue = "INSERT INTO slot_requests VALUES($requestID,$period0)";
        if (mysqli_query($con1->connectDetail(), $insertSlotsQue)) {
            echo "Venues_requests select";
        }else {
            echo "Error: " . $insertSlotsQue . "<br>" . mysqli_error($con1);
        }
    }

    public function nextButton(){
        header("Location:../SDP/pickClass.html");
        exit();
    }

    public function backButton(){
        header("Location:../MenuNew2/index.html");
        exit();
    }

    public function remain(){
        header("Location:../MenuNew2/BookingForm.html");
        exit();
    }

    public function closeConnection(){
        include_once ('connect.php');
        $con1 = new connect();
        $con1->closeConnection();
    }
}
if(isset($_POST['done'])){
    $numBook = $_POST['number_of_booking'];
    $obj1 = new CourseFeasableNew();
    $obj1->feasable();
    $numBook = $numBook -1;
    while($numBook > 0) {
        $obj1->insertVenueReq();
        $obj1->insertSlotsReq();
        $obj1->closeConnection();
        $numBook = $numBook -1;
    }
    $obj1->nextButton();
}