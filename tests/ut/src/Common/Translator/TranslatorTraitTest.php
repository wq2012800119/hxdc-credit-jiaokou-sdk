<?php
namespace Sdk\Common\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\NullMockObject;

class TranslatorTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(TranslatorTraitMock::class)
                           ->setMethods(['getNullObject'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testArrayToObject()
    {
        $expression = array();
        $object = NullMockObject::getInstance();
         // 为 getNullObject() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('getNullObject')->willReturn($object);

        $result = $this->stub->arrayToObjectPublic($expression);

        $this->assertEquals($result, $object);
    }

    public function testArrayToObjects()
    {
        $result = $this->stub->arrayToObjectsPublic(array());

        $this->assertEmpty($result);
    }

    public function testTypeFormatConversion()
    {
        $type = 1;
        $typeCnArray = array(1=>'类型');

        $data = array(
            'id' => marmot_encode($type),
            'name' => '类型'
        );

        $result = $this->stub->typeFormatConversionPublic($type, $typeCnArray);

        $this->assertEquals($result, $data);
    }

    public function testStatusFormatConversion()
    {
        $status = 1;
        $statusCnArray = array(1=>'状态');
        $statusTypeArray = array(1=>'success');

        $data = array(
            'id' => marmot_encode($status),
            'type' => 'success',
            'name' => '状态'
        );

        $result = $this->stub->statusFormatConversionPublic($status, $statusTypeArray, $statusCnArray);

        $this->assertEquals($result, $data);
    }
}
