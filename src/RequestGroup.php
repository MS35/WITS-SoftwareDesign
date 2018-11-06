<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 05 Nov 2018
 * Time: 03:59
 */

class RequestGroup
{
    private $booking_id;
    private $class_size;
    private $data_projector;
    private $overhead_projector;
    private $screens;
    private $sound;
    private $speakers;
    private $hdmi_cables;
    private $vga_cables;
    private $document_camera;
    private $start_time;
    private $end_time;
    private $quantity;

    public function __construct($requestArr){
        $this->booking_id = $requestArr[0];
        $this->class_size = $requestArr[1];
        $this->data_projector = $requestArr[2];
        //$boolTy = boolval($requestArr[0]);
        $this->overhead_projector = $requestArr[3];
        $this->screens = $requestArr[4];
        $this->sound = $requestArr[5];
        $this->speakers = $requestArr[6];
        $this->hdmi_cables = $requestArr[7];
        $this->vga_cables = $requestArr[8];
        $this->document_camera = $requestArr[9];
        $this->start_time = $requestArr[10];
        $this->end_time = $requestArr[11];
        $this->quantity = $requestArr[12];
    }

    /**
     * @return mixed
     */
    public function getBookingId()
    {
        return $this->booking_id;
    }

    /**
     * @return mixed
     */
    public function getClassSize()
    {
        return $this->class_size;
    }

    /**
     * @return mixed
     */
    public function getDataProjector()
    {
        return $this->data_projector;
    }

    /**
     * @return mixed
     */
    public function getDocumentCamera()
    {
        return $this->document_camera;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @return mixed
     */
    public function getHdmiCables()
    {
        return $this->hdmi_cables;
    }

    /**
     * @return mixed
     */
    public function getOverheadProjector()
    {
        return $this->overhead_projector;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getScreens()
    {
        return $this->screens;
    }

    /**
     * @return mixed
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @return mixed
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @return mixed
     */
    public function getVgaCables()
    {
        return $this->vga_cables;
    }


}