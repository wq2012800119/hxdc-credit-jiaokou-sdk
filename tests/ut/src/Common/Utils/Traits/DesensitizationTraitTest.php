<?php
namespace Sdk\Common\Utils\Traits;

use PHPUnit\Framework\TestCase;

class DesensitizationTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DesensitizationTraitMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testDataDesensitizationNull()
    {
        $string = '';
        $result = $this->stub->dataDesensitizationPublic($string);

        $this->assertEmpty($result);
    }

    public function testDataDesensitizationLengthOutOfRange()
    {
        $string = '1234';
        $start = 4;
        $end = 2;
        
        $result = $this->stub->dataDesensitizationPublic($string, $start, $end);

        $this->assertEquals($result, $string);
    }
    
    public function testDataDesensitization()
    {
        $string = '123456';
        $start = 1;
        $end = 2;
        $expectResult = '1***56';

        $result = $this->stub->dataDesensitizationPublic($string, $start, $end);

        $this->assertIsString($result);
        $this->assertEquals($result, $expectResult);
    }

    public function testIdCardDesensitization()
    {
        $idCard = '412825199408025764';
        $expectResult = '4128**********5764';

        $result = $this->stub->idCardDataDesensitizationPublic($idCard);

        $this->assertIsString($result);
        $this->assertEquals($result, $expectResult);
    }

    public function testCellphoneDataDesensitization()
    {
        $cellphone = '13720406325';
        $expectResult = '137****6325';

        $result = $this->stub->cellphoneDataDesensitizationPublic($cellphone);

        $this->assertIsString($result);
        $this->assertEquals($result, $expectResult);
    }
}
