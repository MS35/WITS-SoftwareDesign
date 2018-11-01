<?php
/**
  * @coversDefaultClass \MS35\WitsSoftwareDesign\ip
  */
  class connectTest extends \PHPUnit_Framework_TestCase{
    protected $result;
    public function setup(){
      $this->result = new \MS35\WitsSoftwareDesign\ip();
    }
     /*
     * @covers ::getRealIPAddr
     */
     public function testConnectDetail(){
         $this->assertEquals(0,$this->result->getRealIPAddr());
     }
  }
