<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 06 Nov 2018
 * Time: 10:34
 */

include_once('BookingViewer.php');
$bookingsToView = new BookingViewer();
$applications = $bookingsToView->makeLecturersBookingsHTML(1312548);
echo $applications;