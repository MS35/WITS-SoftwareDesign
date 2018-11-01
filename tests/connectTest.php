<?php
/**
  * @coversDefaultClass \MS35\WitsSoftwareDesign\connect
  */
  class connectTest extends \PHPUnit_Framework_TestCase{
    protected $result;
    public function setup(){
      $this->result = new \MS35\WitsSoftwareDesign\connect();
    }
     /*
     * @covers ::connectDetail
     */
     public function testConnectDetail(){
         $this->assertNotNull($this->result->connectDetail());
     }
  }
