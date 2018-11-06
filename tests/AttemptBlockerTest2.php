<?php
/**
 * @coversDefaultClass \MS35\WitsSoftwareDesign\AttemptBlocker
 */
class AttemptBlockerTest2 extends \PHPUnit_Framework_TestCase{
    protected $result;
    
    public function setup(){
        $this->result = new \MS35\WitsSoftwareDesign\AttemptBlocker();
    }
    /*
     * @covers ::addLoginAttempt
     */
    public function testLoginAttempt()
    {
          $this->assertEquals(0,$this->result->addLoginAttempt('0'))
          $this->assertEquals(1,$this->result->addLoginAttempt('0'))
    }
}
