<?php
/**
 * @coversDefaultClass \MS35\WitsSoftwareDesign\access
 */
class accessTest extends \PHPUnit_Framework_TestCase{
    protected $result;

    public function setup(){
        $this->result = new \MS35\WitsSoftwareDesign\access();
    }
    /*
     * @covers ::lec
     */
    public function testlec()
    {
        $this->assertNotNull($this->result->lec());
        //$this->assertEquals(0,$this->result->lec());
        $this->assertEquals(1,$this->result->lec());
    }
}
