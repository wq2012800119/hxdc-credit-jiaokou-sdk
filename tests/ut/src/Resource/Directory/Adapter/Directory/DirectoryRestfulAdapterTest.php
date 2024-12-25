<?php
namespace Sdk\Resource\Directory\Adapter\Directory;

use PHPUnit\Framework\TestCase;
use Sdk\Resource\Directory\Utils\MockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DirectoryRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectoryRestfulAdapterMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsCommonRestfulAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\CommonRestfulAdapter',
            $this->stub
        );
    }

    public function testImplementsIDirectoryAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Adapter\Directory\IDirectoryAdapter',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub->getNullObjectPublic()
        );

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullDirectory',
            $this->stub->getNullObjectPublic()
        );
    }

    //scenario
    /**
     * @dataProvider additionProviderScenario
     */
    public function testScenario($scenario, $expect)
    {
        $this->stub->scenario($scenario);

        $this->assertEquals($expect, $this->stub->getScenario());
    }

    public function additionProviderScenario()
    {
        return array(
            array('DIRECTORY_LIST', DirectoryRestfulAdapter::SCENARIOS['DIRECTORY_LIST']),
            array('DIRECTORY_FETCH_ONE', DirectoryRestfulAdapter::SCENARIOS['DIRECTORY_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(DirectoryRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'identify',
            'subjectCategory',
            'infoCategory',
            'sourceUnits',
            'description',
            'versionDescription',
            'items',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'identify',
            'subjectCategory',
            'infoCategory',
            'sourceUnits',
            'description',
            'versionDescription',
            'items'
        ), $this->stub->updateTranslatorKeysPublic());
    }

    private function initRollback(bool $result)
    {
        $this->stub = $this->getMockBuilder(DirectoryRestfulAdapterMock::class)
                           ->setMethods([
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();

        $resource = 'resource';
        $directory = MockObjectGenerate::generateDirectory(1);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method(
            'patch'
        )->with($resource.'/'.$directory->getId().'/rollback/'.$directory->getSnapshotId());
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($directory);
        }

        return $directory;
    }

    public function testRollbackTrue()
    {
        $directory = $this->initRollback(true);

        $result = $this->stub->rollback($directory);

        $this->assertTrue($result);
    }

    public function testRollbackFalse()
    {
        $directory = $this->initRollback(false);

        $result = $this->stub->rollback($directory);

        $this->assertFalse($result);
    }

    private function initExport(bool $result)
    {
        $this->stub = $this->getMockBuilder(DirectoryRestfulAdapterMock::class)
                           ->setMethods([
                               'post',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();

        $resource = 'resource';
        $directory = MockObjectGenerate::generateDirectory(1);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method(
            'post'
        )->with($resource.'/'.$directory->getId().'/export');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($directory);
        }

        return $directory;
    }

    public function testExportTrue()
    {
        $directory = $this->initExport(true);

        $result = $this->stub->export($directory);

        $this->assertTrue($result);
    }

    public function testExportFalse()
    {
        $directory = $this->initExport(false);

        $result = $this->stub->export($directory);

        $this->assertFalse($result);
    }
}
