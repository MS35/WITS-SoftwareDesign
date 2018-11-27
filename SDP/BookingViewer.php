<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 06 Nov 2018
 * Time: 07:30
 */
include_once('RequestGroup.php');
include_once("Booking.php");
Include_once("BookingFinder.php");

class BookingViewer
{
    private $bookings_elements_array;
    private $requests_elements_array;

    public function __construct(){
        $this->bookings_elements_array = array();
        $this->requests_elements_array = array();
    }

    private function makeRequestsHTML($request_element_id,$booking){
        $requests = $booking->getRequests();

        $html = "<div id='".$request_element_id."' class='collapse'>";

        for($i = 0; $i < count($requests); $i++){
            $request = $requests[$i];
            $html .= "<div  class='card'>";
            $html .= "<div class='card bg-primary text-primary'>";
            $html .= "<div class='card-body text-primary' >";
            $html .= "<form class='form-inline'>";

            $html .= "<input name='booking_id' type='hidden' value='".$request->getBookingId()."'>";
            $html .= "<div>";
            $html .= "<label for='class_size' class='label' >Venue Size:</label>";
            $html .= "<input name='class_size' class='form-control' type='number' value='".$request->getClassSize()."' readonly>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<div class='form-group form-check'>";

            $html .= "<label for='data_projector' class='label'>Data Projector</label>";
            if($request->getDataProjector() === "1"){
                $html .= "<input name='data_projector' type='checkbox' value='".$request->getDataProjector()."' checked disabled>";
            }else{
                $html .= "<input name='data_projector' type='checkbox' value='".$request->getDataProjector()."' disabled>";
            }

            $html .= "<label for='overhead_projector' class='label'>Overhead Projector</label>";
            if($request->getOverheadProjector() === "1"){
                $html .= "<input name='overhead_projector' type='checkbox' value='".$request->getOverheadProjector()."' checked disabled>";
            }else{
                $html .= "<input name='overhead_projector' type='checkbox' value='".$request->getOverheadProjector()."' disabled>";
            }

            $html .= "<label for='screens' class='label'>Screens</label>";
            if($request->getScreens() === "1"){
                $html .= "<input name='screens' type='checkbox' value='".$request->getSCreens()."' checked disabled>";
            }else{
                $html .= "<input name='screens' type='checkbox' value='".$request->getScreens()."' disabled>";
            }

            $html .= "<label for='speakers' class='label'>Speakers</label>";
            if($request->getSpeakers() === "1"){
                $html .= "<input name='speakers' type='checkbox' value='".$request->getSpeakers()."' checked disabled>";
            }else{
                $html .= "<input name='speakers' type='checkbox' value='".$request->getSpeakers()."' disabled>";
            }

            $html .= "<label for='sound' class='label'>Sound</label>";
            if($request->getSound() === "1"){
                $html .= "<input name='sound' type='checkbox' value='".$request->getSound()."' checked disabled>";
            }else{
                $html .= "<input name='sound' type='checkbox' value='".$request->getSound()."' disabled>";
            }

            $html .= "<label for='hdmi_cables' class='label'>HDMI Cables</label>";
            if($request->getHdmiCables() === "1"){
                $html .= "<input name='hdmi_cables' type='checkbox' value='".$request->getHdmiCables()."' checked disabled>";
            }else{
                $html .= "<input name='hdmi_cables' type='checkbox' value='".$request->getHdmiCables()."' disabled>";
            }

            $html .= "<label for='vga_cables' class='label'>VGA Cables</label>";
            if($request->getVgaCables() === "1"){
                $html .= "<input name='vga_cables' type='checkbox' value='".$request->getVgaCables()."' checked disabled>";
            }else{
                $html .= "<input name='vga_cables' type='checkbox' value='".$request->getVgaCables()."' disabled>";
            }

            $html .= "<label for='document_camera' class='label'>Document Camera</label>";
            if($request->getDocumentCamera() === "1"){
                $html .= "<input name='document_camera' type='checkbox' value='".$request->getDocumentCamera()."' checked disabled>";
            }else{
                $html .= "<input name='document_camera' type='checkbox' value='".$request->getDocumentCamera()."' disabled>";
            }

            $html .= "</div>";
            $html .= "</div>";

            $html .= "<div>";
            $html .= "<label for='start_time' class='label'>Start Time:</label>";
            $html .= "<input name='start_time' class='form-control' type='time' value='".$request->getStartTime()."' readonly>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<label for='end_time' class='label'>End Time:</label>";
            $html .= "<input name='end_time' class='form-control' type='time' value='".$request->getEndTime()."' readonly>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<label for='quantity' class='label'>Number Of Venues Requested:</label>";
            $html .= "<input name='quantity' class='form-control' type='number' value='".$request->getQuantity()."' readonly>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</form>";
            $html .= "</div>";
            $html .= "</div>";
        }

        $html .= "</div>";

        return $html;
    }

    public function makeLecturersBookingsHTML($user_id){
        $bookingsFinder = new BookingFinder();
        $bookingsFinder->getLecturerBookings($user_id);
        $bookings = $bookingsFinder->getBookings();

        for($i = 0; $i < count($bookings); $i++){
            $bookingHTML = '';
            $requestHTML = $this->makeRequestsHTML("request-".$i,$bookings[$i]);

            $bookingHTML .= "<div  class='card'>";
            $bookingHTML .= "<div class='card bg-primary text-white' style=\"background-color:Black;\">";
            $bookingHTML .= "<div class='card-body'>";
            $bookingHTML .= "<form class='form-inline'>";
            $bookingHTML .= "<div data-toggle='collapse' data-target='#request-".$i."'>";

            $bookingHTML .= "<label for='#booking_id' class='label label-dark'>Booking ID:</label>";
            $bookingHTML .= "<input name='booking_id' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[0]."' readonly>";
            $bookingHTML .= "<label for='#class_id' class='label label-dark'>Class ID:</label>";
            $bookingHTML .= "<input name='class_id' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[1]."' readonly>";
            $bookingHTML .= "<label for='#activity_type' class='label label-dark'>Type of Instruction:</label>";
            $bookingHTML .= "<input name='activity_type' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[2]."' readonly>";
            $bookingHTML .= "<label for='#active_year_period' class='label label-dark'>Time of the Year:</label>";
            $bookingHTML .= "<input name='active_year_period' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[3]."' readonly>";
            $bookingHTML .= "<label for='#day' class='label label-dark'>Day:</label>";
            $bookingHTML .= "<input name='day' type='text' class='form-control' value='".$bookings[$i]->getBookingInfo()[4]."' readonly>";

            $bookingHTML .= "</div>";

            $bookingHTML .= "</form>";
            $bookingHTML .= "</div>";
            $bookingHTML .= "</div>";
            $bookingHTML .= "</div>";

            array_push($this->bookings_elements_array,$bookingHTML);
            array_push($this->requests_elements_array,$requestHTML);
        }

        $outputHTML = "";
        for($j = 0; $j < count($this->bookings_elements_array); $j++){
            $outputHTML .= $this->bookings_elements_array[$j];
            $outputHTML .= $this->requests_elements_array[$j];
        }

        if($outputHTML == null){
            $outputHTML .= "<p>You do not have any bookings.</p>";
        }

        return $outputHTML;
    }

    public function makeAdminsBookingsHTML($user_id){
        $bookingsFinder = new BookingFinder();
        $bookingsFinder->getAdminBookings($user_id);
        $bookings = $bookingsFinder->getBookings();

        for($i = 0; $i < count($bookings); $i++){
            $bookingHTML = '';
            $requestHTML = $this->makeRequestsHTML("request-".$i,$bookings[$i]);

            $bookingHTML .= "<div  class='card'>";
            $bookingHTML .= "<div class='card bg-primary text-white' style=\"background-color:Black;\">";
            $bookingHTML .= "<div class='card-body'>";
            $bookingHTML .= "<form class='form-inline'>";
            $bookingHTML .= "<div data-toggle='collapse' data-target='#request-".$i."'>";

            $bookingHTML .= "<label for='#booking_id' class='label label-dark'>Booking ID:</label>";
            $bookingHTML .= "<input name='booking_id' class='form-control' type='text' value='".$bookings[$i]->getBooKingInfo()[0]."' readonly>";
            $bookingHTML .= "<label for='#class_id' class='label label-dark'>Class ID:</label>";
            $bookingHTML .= "<input name='class_id' class='form-control' type='text' value='".$bookings[$i]->getBooKingInfo()[1]."' readonly>";
            $bookingHTML .= "<label for='#activity_type' class='label label-dark'>Type of Instruction:</label>";
            $bookingHTML .= "<input name='activity_type' class='form-control' type='text' value='".$bookings[$i]->getBooKingInfo()[2]."' readonly>";
            $bookingHTML .= "<label for='#active_year_period' class='label label-dark'>Time of the Year:</label>";
            $bookingHTML .= "<input name='active_year_period' class='form-control' type='text' value='".$bookings[$i]->getBooKingInfo()[3]."' readonly>";
            $bookingHTML .= "<label for='#day' class='label label-dark'>Day:</label>";
            $bookingHTML .= "<input name='day' type='text' class='form-control' value='".$bookings[$i]->getBooKingInfo()[4]."' readonly>";

            $bookingHTML .= "</div>";

            $bookingHTML .= "</form>";
            $bookingHTML .= "</div>";
            $bookingHTML .= "</div>";
            $bookingHTML .= "</div>";

            array_push($this->bookings_elements_array,$bookingHTML);
            array_push($this->requests_elements_array,$requestHTML);
        }

        $outputHTML = "";
        for($j = 0; $j < count($this->bookings_elements_array); $j++){
            $outputHTML .= $this->bookings_elements_array[$j];
            $outputHTML .= $this->requests_elements_array[$j];
        }

        if($outputHTML == null){
            $outputHTML .= "<p>You do not have any bookings.</p>";
        }

        return $outputHTML;
    }

    public function makePIMDBookingsHTML(){
        $bookingsFinder = new BookingFinder();
        $bookingsFinder->getPIMDBookings();
        $bookings = $bookingsFinder->getBookings();

        for($i = 0; $i < count($bookings); $i++){
            $bookingHTML = '';
            $requestHTML = $this->makeRequestsHTML("request-".$i,$bookings[$i]);

            $bookingHTML .= "<div  class='card'>";
            $bookingHTML .= "<div class='card bg-primary text-white' style=\"background-color:Black;\">";
            $bookingHTML .= "<div class='card-body'>";
            $bookingHTML .= "<form>";
            $bookingHTML .= "<span data-toggle='collapse' data-target='#request-".$i."'>";

            $bookingHTML .= "<label for='#booking_id' class='label label-dark'>Booking ID:</label>";
            $bookingHTML .= "<input name='booking_id' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[0]."' readonly>";
            $bookingHTML .= "<label for='#class_id' class='label label-dark'>Class ID:</label>";
            $bookingHTML .= "<input name='class_id' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[1]."' readonly>";
            $bookingHTML .= "<label for='#activity_type' class='label label-dark'>Type of Instruction:</label>";
            $bookingHTML .= "<input name='activity_type' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[2]."' readonly>";
            $bookingHTML .= "<label for='#active_year_period' class='label label-dark'>Time of the Year:</label>";
            $bookingHTML .= "<input name='active_year_period' class='form-control' type='text' value='".$bookings[$i]->getBookingInfo()[3]."' readonly>";
            $bookingHTML .= "<label for='#day' class='label label-dark'>Day:</label>";
            $bookingHTML .= "<input name='day' type='text' class='form-control' value='".$bookings[$i]->getBookingInfo()[4]."' readonly>";
            $bookingHTML .= "<label for='#booker' class='label label-dark'>Booker:</label>";
            $bookingHTML .= "<input name='booker' type='text' class='form-control' value='".$bookings[$i]->getBookingInfo()[5]." ";
            $bookingHTML .= $bookings[$i]->getBookingInfo()[6]." ".$bookings[$i]->getBookingInfo()[7]."' readonly>";
            $bookingHTML .= "<label for='#number' class='label label-dark'>Contact Number:</label>";
            $bookingHTML .= "<input name='number' type='text' class='form-control' value='".$bookings[$i]->getBookingInfo()[8]."' readonly>";
            $bookingHTML .= "<label for='#email' class='label label-dark'>Email:</label>";
            $bookingHTML .= "<input name='email' type='text' class='form-control' value='".$bookings[$i]->getBookingInfo()[9]."' readonly>";

            $bookingHTML .= "</span>";

            $bookingHTML .= "</form>";
            $bookingHTML .= "</div>";
            $bookingHTML .= "</div>";
            $bookingHTML .= "</div>";

            array_push($this->bookings_elements_array,$bookingHTML);
            array_push($this->requests_elements_array,$requestHTML);
        }

        $outputHTML = "";
        for($j = 0; $j < count($this->bookings_elements_array); $j++){
            $outputHTML .= $this->bookings_elements_array[$j];
            $outputHTML .= $this->requests_elements_array[$j];
        }

        if($outputHTML == null){
            $outputHTML .= "<p>No bookings have been made.</p>";
        }else{
            $output = "<p>Click on a booking to view the details</p>".$outputHTML;
            $outputHTML = $outputHTML;
        }
        return $outputHTML;
    }

}