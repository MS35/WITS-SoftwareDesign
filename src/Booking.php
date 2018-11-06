<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 05 Nov 2018
 * Time: 15:00
 */
include_once('RequestGroup.php');
include_once('DBConnector.php');
class Booking
{
    protected $bookingInfoArr;
    protected $groupedRequests;
    protected $booking_id;
    private $db_name;

    public function getBookingInfo(){
        return $this->bookingInfoArr;
    }

    public function getRequests(){
        return $this->groupedRequests;
    }

    public function __construct($bookingVals)
    {
        $this->bookingInfoArr = $bookingVals;
        $this->groupedRequests = array();
        $this->db_name = "venue_allocations_db";
        $this->booking_id = $this->bookingInfoArr[0];
    }

    public function fetchRequests(){
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getRequestsSQL = "SELECT venue_requests.booking_id,";
        $getRequestsSQL .= "venue_requests.class_size, ";
        $getRequestsSQL .= "venue_requests.data_projector, ";
        $getRequestsSQL .= "venue_requests.overhead_projector, ";
        $getRequestsSQL .= "venue_requests.screens, ";
        $getRequestsSQL .= "venue_requests.sound, ";
        $getRequestsSQL .= "venue_requests.speakers, ";
        $getRequestsSQL .= "venue_requests.hdmi_cables, ";
        $getRequestsSQL .= "venue_requests.vga_cables, ";
        $getRequestsSQL .= "venue_requests.document_camera, ";
        $getRequestsSQL .= "slots.start_time, ";
        $getRequestsSQL .= "slots.end_time, ";
        $getRequestsSQL .= "COUNT(*) AS quantity ";
        $getRequestsSQL .= "FROM venue_requests, slots, slot_requests ";
        $getRequestsSQL .= "WHERE venue_requests.booking_id = '".$this->booking_id."' ";
        $getRequestsSQL .= "AND venue_requests.request_id = slot_requests.request_id ";
        $getRequestsSQL .= "AND slot_requests.slot_num = slots.slot_num ";
        $getRequestsSQL .= "GROUP BY venue_requests.booking_id,";
        $getRequestsSQL .= "venue_requests.class_size, ";
        $getRequestsSQL .= "venue_requests.data_projector, ";
        $getRequestsSQL .= "venue_requests.overhead_projector, ";
        $getRequestsSQL .= "venue_requests.screens, ";
        $getRequestsSQL .= "venue_requests.sound, ";
        $getRequestsSQL .= "venue_requests.speakers, ";
        $getRequestsSQL .= "venue_requests.hdmi_cables, ";
        $getRequestsSQL .= "venue_requests.vga_cables, ";
        $getRequestsSQL .= "venue_requests.document_camera, ";
        $getRequestsSQL .= "slots.start_time, ";
        $getRequestsSQL .= "slots.end_time";

        if($getRequestsSQLResponse = mysqli_query($connection, $getRequestsSQL)) {
            // output data of each row

            while($row=mysqli_fetch_row($getRequestsSQLResponse)){
                $requestGroup = new RequestGroup($row);
                array_push($this->groupedRequests,$requestGroup);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);
    }
}