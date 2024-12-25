<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

class NullFetchRepositoryTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullFetchRepositoryTraitMock::class)
                           ->setMethods(['repositoryNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testFetchOne()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->fetchOnePublic(1);

        $this->assertFalse($result);
    }

    public function testFetchList()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->fetchListPublic(array(1));

        $this->assertFalse($result);
    }

    public function testSearch()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->searchPublic();

        $this->assertFalse($result);
    }

    public function testFetchOneAsync()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->fetchOneAsyncPublic(1);

        $this->assertFalse($result);
    }

    public function testFetchListAsync()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->fetchListAsyncPublic(array(1));

        $this->assertFalse($result);
    }

    public function testSearchAsync()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->searchAsyncPublic();

        $this->assertFalse($result);
    }
}
