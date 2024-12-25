<?php
namespace Sdk\Common\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class RestfulTranslatorTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(RestfulTranslatorTraitMock::class)
                           ->setMethods(['arrayToObject', 'singleArrayToObjects', 'listArrayToObjects'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testArrayToObjectsEmpty()
    {
        $expression = array();

        $result = $this->stub->arrayToObjectsPublic($expression);

        $this->assertEquals($result, [0, []]);
    }

    public function testArrayToObjectsSingle()
    {
        $existNextPage = 1;
        $expression = array('data' => array('type'=>'test'), 'meta' => array('existNextPage' => $existNextPage));
        $objects = array('objects');

        $this->stub->expects($this->exactly(1))->method('singleArrayToObjects')->willReturn($objects);

        $result = $this->stub->arrayToObjectsPublic($expression);

        $this->assertEquals($result, [$existNextPage, $objects]);
    }

    public function testArrayToObjectsList()
    {
        $expression = array('data' => array(array('data')));
        $objects = array('objects');

        $this->stub->expects($this->exactly(1))->method('listArrayToObjects')->willReturn($objects);

        $result = $this->stub->arrayToObjectsPublic($expression);

        $this->assertEquals($result, [0, $objects]);
    }

    public function testSingleArrayToObjects()
    {
        $stub = $this->getMockBuilder(RestfulTranslatorTraitMock::class)
                           ->setMethods(['arrayToObject'])
                           ->getMock();

        $expression = array('data' => array('id' => 1));
        $object = new MockObject(1);

         // 为 arrayToObject() 方法建立预期：该方法被调用一次且返回object。
        $stub->expects($this->exactly(1))->method('arrayToObject')->with($expression)->willReturn($object);

        $result = $stub->singleArrayToObjectsPublic($expression);

        $this->assertEquals($result, array(1=>$object));
    }

    public function testListArrayToObjectsEmpty()
    {
        $stub = new RestfulTranslatorTraitMock();
        $expression = array();

        $result = $stub->listArrayToObjectsPublic($expression);

        $this->assertEquals($result, []);
    }

    public function testListArrayToObjects()
    {
        $stub = $this->getMockBuilder(RestfulTranslatorTraitMock::class)
                           ->setMethods(['arrayToObject'])
                           ->getMock();

        $expression = array(
            'meta' => array('count' => 1),
            'data' => array(array('id' => 1)),
            'included' => array('included')
        );
        $object = new MockObject(1);

         // 为 arrayToObject() 方法建立预期：该方法被调用一次且返回object。
        $stub->expects($this->exactly(1))->method('arrayToObject')->willReturn($object);

        $result = $stub->listArrayToObjectsPublic($expression);

        $this->assertEquals($result, array(1=>$object));
    }

    public function testIncludedFormatConversion()
    {
        $included = array(
            array(
                'type' => 'type',
                'id' => 1
            )
        );

        $expect['type'][1] = array(
            'data' => array(
                'type' => 'type',
                'id' => 1
            ),
            'included' => $included
        );
        
        $result = $this->stub->includedFormatConversionPublic($included);

        $this->assertEquals($result, $expect);
    }

    public function testRelationshipFill()
    {
        $relationship = array(
            'data' => array(
                'type' => 'type',
                'id' => 1
            )
        );

        $included['type'][1] = array(
            'data' => array(
                'type' => 'type',
                'id' => 1
            ),
            'included' => $relationship
        );
        
        $result = $this->stub->relationshipFillPublic($relationship, $included);

        $this->assertEquals($result, $included['type'][1]);
    }

    public function testRelationshipFillEmpty()
    {
        $relationship = $included = array();

        $result = $this->stub->relationshipFillPublic($relationship, $included);

        $this->assertEmpty($result);
    }

    public function testRelationshipsFillEmpty()
    {
        $relationship = $included = array();

        $result = $this->stub->relationshipsFillPublic($relationship, $included);

        $this->assertEmpty($result);
    }

    public function testRelationshipsFill()
    {
        $relationship = array(
            'data' => array(
                array(
                    'type' => 'type',
                    'id' => 1
                )
            )
        );

        $included['type'][1] = array(
            'data' => array(
                'type' => 'type',
                'id' => 1
            ),
            'included' => $relationship
        );
        
        $expectResult = array($included['type'][1]);

        $result = $this->stub->relationshipsFillPublic($relationship, $included);

        $this->assertEquals($result, $expectResult);
    }
}
