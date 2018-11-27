<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 21 Nov 2018
 * Time: 07:00
 */

include_once("BookingDeleter.php");
$booking_id = $_POST["booking_id"];
$deleter = new BookingDeleter();
do{
    $status = $deleter->deleteBooking($booking_id);
}while(!$status);
header("Location: testDeleteBookings.php");