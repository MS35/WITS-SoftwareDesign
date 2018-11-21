<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 05 Nov 2018
 * Time: 22:06
 */
include_once("Booking.php");
include_once("DBConnector.php");

class BookingDeleter
{
    private $db_name;

    public function __construct()
    {
        $this->db_name = "venue_allocations_db";
    }

    public function deleteBooking($booking_id){
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $deleteBookingSQL = '';
        $deleteBookingSQL .= "DELETE slot_requests.* ";
        $deleteBookingSQL .= "FROM bookings, venue_requests, slot_requests ";
        $deleteBookingSQL .= "WHERE bookings.booking_id = venue_requests.booking_id ";
        $deleteBookingSQL .= "AND slot_requests.request_id = venue_requests.request_id ";
        $deleteBookingSQL .= "AND bookings.booking_id = ".$booking_id.";";

        $deleteBookingSQL .= "DELETE venue_requests.* ";
        $deleteBookingSQL .= "FROM bookings, venue_requests ";
        $deleteBookingSQL .= "WHERE bookings.booking_id = venue_requests.booking_id ";
        $deleteBookingSQL .= "and bookings.booking_id = ".$booking_id.";";

        $deleteBookingSQL .= "DELETE bookings.* ";
        $deleteBookingSQL .= "FROM bookings ";
        $deleteBookingSQL .= "WHERE booking_id = ".$booking_id;

        if($deleteBookingSQLResponse = mysqli_multi_query($connection, $deleteBookingSQL)) {
            $output = true;
        }else{
            $output = false;
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);

        return $output;
    }
}