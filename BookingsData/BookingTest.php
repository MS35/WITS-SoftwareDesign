<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 05 Nov 2018
 * Time: 21:11
 */

include_once("Booking.php");
include_once("BookingFinder.php");

$book = new Booking(array(15,250));

$bookings = new BookingFinder();
$bookings->getPIMDBookings();
$bookings1 = new BookingFinder();
$bookings1->getLecturerBookings(1312548);
$bookings2 = new BookingFinder();
$bookings2->getAdminBookings(1233445);
echo "Admin bookings size: ".count($bookings2->getBookings())."\n";