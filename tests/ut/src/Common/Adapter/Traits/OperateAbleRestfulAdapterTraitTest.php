<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;
use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Common\Model\MockObject;

class OperateAbleRestfulAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(OperateAbleRestfulAdapterTraitMock::class)
                           ->setMethods([
                               'insertTranslatorKeys',
                               'updateTranslatorKeys',
                               'getTranslator',
                               'post',
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    private function insert(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $data = $keys = array();
        $operateAbleObject = new MockObject($id);
        
        $this->stub->expects($this->exactly(1))->method('insertTranslatorKeys')->willReturn($keys);

        // 为 IRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(IRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($operateAbleObject, $keys)->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('post')->with($resource, $data);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($operateAbleObject);
        }

        return $operateAbleObject;
    }

    public function testInsertTrue()
    {
        $operateAbleObject = $this->insert(true);

        $result = $this->stub->insertPublic($operateAbleObject);

        $this->assertTrue($result);
    }

    public function testInsertFalse()
    {
        $operateAbleObject = $this->insert(false);

        $result = $this->stub->insertPublic($operateAbleObject);

        $this->assertFalse($result);
    }

    private function update(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $data = $keys = array();
        $operateAbleObject = new MockObject($id);
        
        $this->stub->expects($this->exactly(1))->method('updateTranslatorKeys')->willReturn($keys);

        // 为 IRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(IRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($operateAbleObject, $keys)->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id, $data);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($operateAbleObject);
        }

        return $operateAbleObject;
    }

    public function testUpdateTrue()
    {
        $operateAbleObject = $this->update(true);

        $result = $this->stub->updatePublic($operateAbleObject);

        $this->assertTrue($result);
    }

    public function testUpdateFalse()
    {
        $operateAbleObject = $this->update(false);

        $result = $this->stub->updatePublic($operateAbleObject);

        $this->assertFalse($result);
    }

    private function enable(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $operateAbleObject = new MockObject($id);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/enable');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($operateAbleObject);
        }

        return $operateAbleObject;
    }

    public function testEnableTrue()
    {
        $operateAbleObject = $this->enable(true);

        $result = $this->stub->enablePublic($operateAbleObject);

        $this->assertTrue($result);
    }

    public function testEnableFalse()
    {
        $operateAbleObject = $this->enable(false);

        $result = $this->stub->enablePublic($operateAbleObject);

        $this->assertFalse($result);
    }

    private function disable(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $operateAbleObject = new MockObject($id);
        
        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/disable');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($operateAbleObject);
        }

        return $operateAbleObject;
    }

    public function testDisableTrue()
    {
        $operateAbleObject = $this->disable(true);

        $result = $this->stub->disablePublic($operateAbleObject);

        $this->assertTrue($result);
    }

    public function testDisableFalse()
    {
        $operateAbleObject = $this->disable(false);

        $result = $this->stub->disablePublic($operateAbleObject);

        $this->assertFalse($result);
    }
}
