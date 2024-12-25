<?php
namespace Sdk\Role\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Role\Utils\MockObjectGenerate;
use Sdk\Role\Utils\TranslatorUtilsTrait;

class RoleTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RoleTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsITranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\ITranslator',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $stub = new RoleTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Role\Model\NullRole',
            $stub->getNullObjectPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $expression = array();
        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Role\Model\NullRole',
            $result
        );
    }

    public function testArrayToObject()
    {
        $stub = $this->getMockBuilder(RoleTranslatorMock::class)
                           ->setMethods([
                               'purviewFormatConversionToObject'
                            ])->getMock();

        $role = MockObjectGenerate::generateRole(1);

        $purview = $role->getPurview();
        $purviewFormatConversion = array('purviewFormatConversion');
        $stub->expects($this->exactly(1))->method(
            'purviewFormatConversionToObject'
        )->with($purviewFormatConversion)->willReturn($purview);
        
        $expression['id'] = marmot_encode($role->getId());
        $expression['name'] = $role->getName();
        $expression['purview'] = $purviewFormatConversion;
        $expression['status'] = $role->getStatus();
        $expression['statusTime'] = $role->getStatusTime();
        $expression['createTime'] = $role->getCreateTime();
        $expression['updateTime'] = $role->getUpdateTime();

        $result = $stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Role\Model\Role',
            $result
        );

        $this->assertEquals($result->getPurview(), $purview);
        $this->compareTranslatorEquals($expression, $result);
    }

    public function testObjectToArrayEmpty()
    {
        $role = array();
        $result = $this->stub->objectToArray($role);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(RoleTranslatorMock::class)
                           ->setMethods([
                               'purviewFormatConversionToArray'
                            ])->getMock();

        $role = MockObjectGenerate::generateRole(1);
        $purview = $role->getPurview();
        $purviewFormatConversion = array('purviewFormatConversion');

        $stub->expects($this->exactly(1))->method(
            'purviewFormatConversionToArray'
        )->with($purview)->willReturn($purviewFormatConversion);
        
        $result = $stub->objectToArray($role);

        $this->assertEquals($result['purview'], $purviewFormatConversion);
        $this->compareTranslatorEquals($result, $role);
    }

    public function testPurviewFormatConversionToArray()
    {
        $stub = new RoleTranslatorMock();

        $purview = array(1=>3, 2=>6);

        $purviewResult = array(
            array(
                'id' => 1,
                'actions' => 3
            ),
            array(
                'id' => 2,
                'actions' => 6
            )
        );

        $result = $stub->purviewFormatConversionToArrayPublic($purview);
        $this->assertEquals($purviewResult, $result);
    }

    public function testPurviewFormatConversionToObject()
    {
        $stub = new RoleTranslatorMock();

        $purviewResult = array(1=>3, 2=>6);

        $purview = array(
            array(
                'id' => 1,
                'actions' => 3
            ),
            array(
                'id' => 2,
                'actions' => 6
            )
        );

        $result = $stub->purviewFormatConversionToObjectPublic($purview);
        $this->assertEquals($purviewResult, $result);
    }
}
