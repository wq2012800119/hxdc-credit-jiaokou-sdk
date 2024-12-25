<?php
namespace Sdk\Common\Adapter\Traits;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MapErrorsTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods(['getContents'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testLastErrorPointerNull()
    {
        $contents = array();
        $this->stub->expects($this->exactly(1))->method('getContents')->willReturn($contents);

        $result = $this->stub->lastErrorPointer();

        $this->assertEmpty($result);
    }

    public function testLastErrorPointer()
    {
        $contents = array(
            'errors' => array(
                array(
                    'meta' => array('field' => 'title')
                )
            )
        );
        $this->stub->expects($this->exactly(1))->method('getContents')->willReturn($contents);

        $result = $this->stub->lastErrorPointer();

        $this->assertEquals($result, 'title');
    }

    public function testGetMapErrors()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods([
                               'getAlonePossessMapErrors',
                               'commonMapErrors'
                            ])->getMock();

        $alonePossessMapError = array(1);
        $commonMapErrors = array(2);
        $mapError = $alonePossessMapError + $commonMapErrors;

        $stub->expects($this->exactly(1))->method('getAlonePossessMapErrors')->willReturn($alonePossessMapError);
        $stub->expects($this->exactly(1))->method('commonMapErrors')->willReturn($commonMapErrors);

        $result = $stub->getMapErrorsPublic();

        $this->assertEquals($result, $mapError);
    }

    public function testCommonMapErrors()
    {
        $result = $this->stub->commonMapErrorsPublic();

        $this->assertIsArray($result);
    }

    public function testMapErrorsSingle()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods([
                               'isSingleErrors',
                               'singleMapErrors'
                            ])->getMock();

        $stub->expects($this->exactly(1))->method('isSingleErrors')->willReturn(true);
        $stub->expects($this->exactly(1))->method('singleMapErrors');

        $stub->mapErrorsPublic();
    }

    public function testMapErrorsMultiple()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods([
                               'isSingleErrors',
                               'multipleMapErrors'
                            ])->getMock();

        $stub->expects($this->exactly(1))->method('isSingleErrors')->willReturn(false);
        $stub->expects($this->exactly(1))->method('multipleMapErrors');

        $stub->mapErrorsPublic();
    }

    public function testSingleMapErrors()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods([
                               'lastErrorId',
                               'lastErrorPointer',
                               'getMapErrors'
                            ])->getMock();

        $id = 10;
        $pointer = 'test';
        $mapErrors = [$id => RESOURCE_NOT_EXIST];

        $stub->expects($this->exactly(1))->method('lastErrorId')->willReturn($id);
        $stub->expects($this->exactly(1))->method('lastErrorPointer')->willReturn($pointer);
        $stub->expects($this->exactly(1))->method('getMapErrors')->willReturn($mapErrors);

        $stub->singleMapErrorsPublic();
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
        $this->assertEquals(array('pointer' => $pointer), Core::getLastError()->getSource());
    }

    public function testSingleMapErrorsPointer()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods([
                               'lastErrorId',
                               'lastErrorPointer',
                               'getMapErrors'
                            ])->getMock();

        $id = 10;
        $pointer = 'items.test';
        $mappingPointer = 'items';
        $sourcePointer = 'test';
        $mapErrors = [$id => [$mappingPointer => RESOURCE_NOT_EXIST]];

        $stub->expects($this->exactly(1))->method('lastErrorId')->willReturn($id);
        $stub->expects($this->exactly(1))->method('lastErrorPointer')->willReturn($pointer);
        $stub->expects($this->exactly(1))->method('getMapErrors')->willReturn($mapErrors);

        $stub->singleMapErrorsPublic();
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
        $this->assertEquals(array('pointer' => $sourcePointer), Core::getLastError()->getSource());
    }

    protected function initMultipleMapErrors($mapErrors)
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)
                           ->setMethods([
                               'getContents',
                               'getMapErrors'
                            ])->getMock();

        $id = 10;
        $contents = array(
            'errors' => array(
                array('id' => $id, 'meta' => array('field' => 'items.0.test')),
                array('id' => $id, 'meta' => array('field' => 'items.1.test'))
            )
        );
        $pointer = '0.test,1.test';

        $stub->expects($this->exactly(1))->method('getContents')->willReturn($contents);
        $stub->expects($this->exactly(1))->method('getMapErrors')->willReturn($mapErrors);

        $stub->multipleMapErrorsPublic();
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
        $this->assertEquals(array('pointer' => $pointer), Core::getLastError()->getSource());
    }

    public function testMultipleMapErrors()
    {
        $id = 10;
        $mapErrors = [$id => RESOURCE_NOT_EXIST];
        $this->initMultipleMapErrors($mapErrors);
    }

    public function testMultipleMapErrorsPointer()
    {
        $id = 10;
        $mapErrors = [$id => ['items' => RESOURCE_NOT_EXIST]];
        $this->initMultipleMapErrors($mapErrors);
    }

    public function testIsSingleErrorsTrue()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)->setMethods(['getContents'])->getMock();

        $contents = array('errors' => array('1'));

        $stub->expects($this->exactly(1))->method('getContents')->willReturn($contents);

        $result = $stub->isSingleErrorsPublic();
        $this->assertTrue($result);
    }

    public function testIsSingleErrorsFalse()
    {
        $stub = $this->getMockBuilder(MapErrorsTraitMock::class)->setMethods(['getContents'])->getMock();

        $contents = array('errors' => array('1', '2'));

        $stub->expects($this->exactly(1))->method('getContents')->willReturn($contents);

        $result = $stub->isSingleErrorsPublic();
        $this->assertFalse($result);
    }
}
