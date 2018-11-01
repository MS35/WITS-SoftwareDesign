<?php
/**
  * @coversDefaultClass \MS35\WitsSoftwareDesign\ip
  */
  class ipTest extends \PHPUnit_Framework_TestCase{
    protected $result;
    public function setup(){
      $this->result = new \MS35\WitsSoftwareDesign\ip();
    }
     /*
     * @covers ::getRealIPAddr
     */
     public function testgetRealIPAddr(){
         $this->assertEquals(0,$this->result->getRealIPAddr());
     }
  }
