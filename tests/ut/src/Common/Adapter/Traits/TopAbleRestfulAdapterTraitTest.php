<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;
use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Common\Model\MockObject;

class TopAbleRestfulAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(TopAbleRestfulAdapterTraitMock::class)
                           ->setMethods([
                               'getTranslator',
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

    private function top(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $topAbleObject = new MockObject($id);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/top');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($topAbleObject);
        }

        return $topAbleObject;
    }

    public function testTopTrue()
    {
        $topAbleObject = $this->top(true);

        $result = $this->stub->topPublic($topAbleObject);

        $this->assertTrue($result);
    }

    public function testTopFalse()
    {
        $topAbleObject = $this->top(false);

        $result = $this->stub->topPublic($topAbleObject);

        $this->assertFalse($result);
    }

    private function cancelTop(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $topAbleObject = new MockObject($id);
        
        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/cancelTop');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($topAbleObject);
        }

        return $topAbleObject;
    }

    public function testCancelTopTrue()
    {
        $topAbleObject = $this->cancelTop(true);

        $result = $this->stub->cancelTopPublic($topAbleObject);

        $this->assertTrue($result);
    }

    public function testCancelTopFalse()
    {
        $topAbleObject = $this->cancelTop(false);

        $result = $this->stub->cancelTopPublic($topAbleObject);

        $this->assertFalse($result);
    }
}
