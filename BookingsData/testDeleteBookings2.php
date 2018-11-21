<?php
/**
 * Created by PhpStorm.
 * User: Tlotlang
 * Date: 20 Nov 2018
 * Time: 12:45
 */

include_once('DeleteBookingsViewer.php');
$bookingsToView = new DeleteBookingsViewer();
$applications = $bookingsToView->makeLecturersBookingsHTML(1312548);
echo $applications;
