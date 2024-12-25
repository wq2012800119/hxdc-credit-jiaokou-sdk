<?php
namespace Sdk\Article\Category\Adapter\Category;

use PHPUnit\Framework\TestCase;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Translator\CategoryRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CategoryRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryRestfulAdapterMock();
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

    public function testImplementsICategoryAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Category\Adapter\Category\ICategoryAdapter',
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
            'Sdk\Article\Category\Model\NullCategory',
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
            array('CATEGORY_LIST', CategoryRestfulAdapter::SCENARIOS['CATEGORY_LIST']),
            array('CATEGORY_FETCH_ONE', CategoryRestfulAdapter::SCENARIOS['CATEGORY_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(CategoryRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'level',
            'parentCategory',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array('name', 'staff'), $this->stub->updateTranslatorKeysPublic());
    }

    private function initDiy(bool $result)
    {
        $this->stub = $this->getMockBuilder(CategoryRestfulAdapterMock::class)
                           ->setMethods([
                               'getTranslator',
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();

        $id = 1;
        $resource = 'resource';
        $category = new Category($id);
        $data = array('data');

        // 为 CategoryRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(CategoryRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($category, array('style', 'diyContent'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/diy', $data);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($category);
        }

        return $category;
    }

    public function testDiyTrue()
    {
        $category = $this->initDiy(true);

        $result = $this->stub->diy($category);

        $this->assertTrue($result);
    }

    public function testDiyFalse()
    {
        $category = $this->initDiy(false);

        $result = $this->stub->diy($category);

        $this->assertFalse($result);
    }
}
