<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 05 Nov 2018
 * Time: 22:06
 */
include_once("Booking.php");
include_once("DBConnector.php");

class BookingFinder
{
    protected $bookings;
    private $db_name;

    /**
     * @return array
     */
    public function getBookings(): array
    {
        return $this->bookings;
    }

    public function __construct()
    {
        $this->bookings = array();
        $this->db_name = "venue_allocations_db";
    }

    public function getLecturerBookings($user_id){
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getBookingsSQL = "SELECT DISTINCT bookings.booking_id, ";
        $getBookingsSQL .= "bookings.class_id, bookings.activity_type, ";
        $getBookingsSQL .= "bookings.active_year_period, slots.day ";

        $getBookingsSQL .= "FROM courses, classes, bookings, venue_requests, ";
        $getBookingsSQL .= "slots, slot_requests ";

        $getBookingsSQL .= "WHERE ((classes.class_id = bookings.class_id ";
        $getBookingsSQL .= "AND bookings.booking_id = venue_requests.booking_id ";
        $getBookingsSQL .= "AND venue_requests.request_id = slot_requests.request_id ";
        $getBookingsSQL .= "AND slot_requests.slot_num = slots.slot_num) ";

        $getBookingsSQL .= "AND (classes.lecturer_id = '".$user_id."' OR ";
        $getBookingsSQL .= "(courses.coordinator_id = '".$user_id."' AND ";
        $getBookingsSQL .= "courses.course_code = classes.course_code))) ";

        $getBookingsSQL .= "OR (bookings.booking_id = venue_requests.booking_id ";
        $getBookingsSQL .= "AND venue_requests.request_id = slot_requests.request_id ";
        $getBookingsSQL .= "AND slot_requests.slot_num = slots.slot_num ";
        $getBookingsSQL .= "AND bookings.booker_id = '".$user_id."')";

        if($getBookingsSQLResponse = mysqli_query($connection, $getBookingsSQL)) {
            // output data of each row

            while($row=mysqli_fetch_row($getBookingsSQLResponse)){
                $booking = new Booking($row);
                array_push($this->bookings,$booking);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);
    }

    public function getAdminBookings($user_id){
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getBookingsSQL = "SELECT DISTINCT bookings.booking_id, ";
        $getBookingsSQL .= "bookings.class_id, bookings.activity_type, ";
        $getBookingsSQL .= "bookings.active_year_period, slots.day ";

        $getBookingsSQL .= "FROM courses, classes, bookings, venue_requests, ";
        $getBookingsSQL .= "slots, slot_requests, users ";

        $getBookingsSQL .= "WHERE users.user_id = '".$user_id."' ";
        $getBookingsSQL .= "AND users.user_organisation = courses.school ";
        $getBookingsSQL .= "AND courses.course_code = classes.course_code ";
        $getBookingsSQL .= "AND classes.class_id = bookings.class_id ";
        $getBookingsSQL .= "AND bookings.booking_id = venue_requests.booking_id ";
        $getBookingsSQL .= "AND venue_requests.request_id = slot_requests.request_id ";
        $getBookingsSQL .= "AND slot_requests.slot_num = slots.slot_num";
        
        if($getBookingsSQLResponse = mysqli_query($connection, $getBookingsSQL)) {
            // output data of each row

            while($row=mysqli_fetch_row($getBookingsSQLResponse)){
                $booking = new Booking($row);
                array_push($this->bookings,$booking);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);
    }

    public function getPIMDBookings(){
        $connector = new DBConnector();

        do{
            $isConnected = $connector->createConnection();
        }while(!$isConnected);

        $connection = $connector->getConnection();

        do{
            $useDBresult = mysqli_select_db($connection,$this->db_name);
        }while(!$useDBresult);

        $getBookingsSQL = "SELECT DISTINCT bookings.booking_id, ";
        $getBookingsSQL .= "bookings.class_id, bookings.activity_type, ";
        $getBookingsSQL .= "bookings.active_year_period, slots.day, ";
        $getBookingsSQL .= "users.user_title, users.user_fname, ";
        $getBookingsSQL .= "users.user_lname, users.user_phone, ";
        $getBookingsSQL .= "users.user_email ";

        $getBookingsSQL .= "FROM courses, classes, bookings, venue_requests, ";
        $getBookingsSQL .= "slots, slot_requests, users ";

        $getBookingsSQL .= "WHERE users.user_id = bookings.booker_id ";
        $getBookingsSQL .= "AND bookings.booking_id = venue_requests.booking_id ";
        $getBookingsSQL .= "AND venue_requests.request_id = slot_requests.request_id ";
        $getBookingsSQL .= "AND slot_requests.slot_num = slots.slot_num";

        if($getBookingsSQLResponse = mysqli_query($connection, $getBookingsSQL)) {
            // output data of each row

            while($row=mysqli_fetch_row($getBookingsSQLResponse)){
                $booking = new Booking($row);
                array_push($this->bookings,$booking);
            }
        }

        do{
            $isConnClosed = $connector->closeConnection();
        }while(!$isConnClosed);
    }
}