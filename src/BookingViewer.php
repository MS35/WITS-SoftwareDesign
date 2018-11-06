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
        $requests = $booking->getRequests;

        $html = "<div id='".$request_element_id."' class='collapse'>";

        for($i = 0; $i < count($requests); $i++){
            $html .= "<form>";

            $html .= "<input name='booking_id' type='hidden' value='".$requests[$i].getBookingId().">";
            $html .= "<input name='class_size' type='number' value='".$requests[$i].getClassSize()." readonly>";

            if($requests[$i].getDataProjector() === "1"){
                $html .= "<input name='data_projector' type='checkbox' value='".$requests[$i].getDataProjector()." checked readonly>";
            }else{
                $html .= "<input name='data_projector' type='checkbox' value='".$requests[$i].getDataProjector()." readonly>";
            }

            if($requests[$i].getOverheadProjector() === "1"){
                $html .= "<input name='overhead_projector' type='checkbox' value='".$requests[$i].getOverheadProjector()." checked readonly>";
            }else{
                $html .= "<input name='overhead_projector' type='checkbox' value='".$requests[$i].getOverheadProjector()." readonly>";
            }

            if($requests[$i].getScreens() === "1"){
                $html .= "<input name='screens' type='checkbox' value='".$requests[$i].getSCreens()." checked readonly>";
            }else{
                $html .= "<input name='screens' type='checkbox' value='".$requests[$i].getScreens()." readonly>";
            }

            if($requests[$i].getSpeakers() === "1"){
                $html .= "<input name='speakers' type='checkbox' value='".$requests[$i].getSpeakers()." checked readonly>";
            }else{
                $html .= "<input name='speakers' type='checkbox' value='".$requests[$i].getSpeakers()." readonly>";
            }

            if($requests[$i].getSound() === "1"){
                $html .= "<input name='sound' type='checkbox' value='".$requests[$i].getSound()." checked readonly>";
            }else{
                $html .= "<input name='sound' type='checkbox' value='".$requests[$i].getSound()." readonly>";
            }

            if($requests[$i].getHdmiCables() === "1"){
                $html .= "<input name='hdmi_cables' type='checkbox' value='".$requests[$i].getHdmiCables()." checked readOnly>";
            }else{
                $html .= "<input name='hdmi_cables' type='checkbox' value='".$requests[$i].getHdmiCables()." readonly>";
            }

            if($requests[$i].getVgaCables() === "1"){
                $html .= "<input name='vga_cables' type='checkbox' value='".$requests[$i].getgetVgaCables()." checked readonly>";
            }else{
                $html .= "<input name='vga_cables' type='checkbox' value='".$requests[$i].getgetVgaCables()." readonly>";
            }

            if($requests[$i].getDocumentCamera() === "1"){
                $html .= "<input name='document_camera' type='checkbox' value='".$requests[$i].getDocumentCamera()." checked readonly>";
            }else{
                $html .= "<input name='document_camera' type='checkbox' value='".$requests[$i].getDocumentCamera()." readonly>";
            }

            $html .= "<input name='start_time' type='time' value='".$requests[$i].getStartTime()." readonly>";

            $html .= "<input name='end_time' type='time' value='".$requests[$i].getEndTime()." readonly>";

            $html .= "<input name='quantity' type='number' value='".$requests[$i].getQuantity()." readonly>";

            $html .= "</form>";
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
            $requestHTML = $this->makeRequestsHTML("request-".$i,$bookings[i]);

            $bookingHTML .= "<div  class='btn-group btn-group-lg'>";
            $bookingHTML .= "<form>";
            $bookingHTML .= "<span data-toggle='collapse' data-target='request-".$i."'>";

            $bookingHTML .= "<input name='booking_id' type='text' value='".$bookings[$i].getBooKingInfo()[0]." readonly>";
            $bookingHTML .= "<input name='class_id' type='text' value='".$bookings[$i].getBooKingInfo()[1]." readonly>";
            $bookingHTML .= "<input name='activity_type' type='text' value='".$bookings[$i].getBooKingInfo()[2]." readonly>";
            $bookingHTML .= "<input name='active_year_period' type='text' value='".$bookings[$i].getBooKingInfo()[3]." readonly>";
            $bookingHTML .= "<input name='day' type='text' value='".$bookings[$i].getBooKingInfo()[4]." readonly>";

            $bookingHTML .= "</span>";
            $bookingHTML .= "</form>";
            $bookingHTML .= "</div><br>";

            array_push($this->bookings_elements_array,$bookingHTML);
            array_push($this->requests_elements_array,$requestHTML);
        }

        $outputHTML = "";
        for($j = 0; $j < count($this->bookings_elements_array); $j++){
            $outputHTML .= $this->bookings_elements_array[$j];
        }
        for($k = 0; $k < count($this->bookings_elements_array); $k++){
            $outputHTML .= $this->bookings_elements_array[$k];
        }

        return $outputHTML;
    }
}