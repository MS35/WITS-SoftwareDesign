<?php
/**
 * @coversDefaultClass \MS35\WitsSoftwareDesign\access
 */
class accessTest extends PHPUnit_Framework_TestCase
{
    protected $result;
    public function setUp(){
        $this->result = new \MS35\WitsSoftwareDesign\access();
    }
    /*
     * @covers ::accessgood
     */
    public function testAccess(){
        //$this->assertSame('failed',$this->result->accessBad());
        $this->assertSame('failed',$this->result->accessGood());
        $this->assertNotNull($this->result->accessGood());
    }
}
