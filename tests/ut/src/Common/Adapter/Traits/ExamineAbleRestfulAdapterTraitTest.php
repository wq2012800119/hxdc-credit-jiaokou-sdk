<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;
use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Common\Model\MockObject;

class ExamineAbleRestfulAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(ExamineAbleRestfulAdapterTraitMock::class)
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

    private function approve(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $examineAbleObject = new MockObject($id);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/approve');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($examineAbleObject);
        }

        return $examineAbleObject;
    }

    public function testApproveTrue()
    {
        $examineAbleObject = $this->approve(true);

        $result = $this->stub->approvePublic($examineAbleObject);

        $this->assertTrue($result);
    }

    public function testApproveFalse()
    {
        $examineAbleObject = $this->approve(false);

        $result = $this->stub->approvePublic($examineAbleObject);

        $this->assertFalse($result);
    }

    private function reject(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $examineAbleObject = new MockObject($id);
        
        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/reject');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($examineAbleObject);
        }

        return $examineAbleObject;
    }

    public function testRejectTrue()
    {
        $examineAbleObject = $this->reject(true);

        $result = $this->stub->rejectPublic($examineAbleObject);

        $this->assertTrue($result);
    }

    public function testRejectFalse()
    {
        $examineAbleObject = $this->reject(false);

        $result = $this->stub->rejectPublic($examineAbleObject);

        $this->assertFalse($result);
    }
}
