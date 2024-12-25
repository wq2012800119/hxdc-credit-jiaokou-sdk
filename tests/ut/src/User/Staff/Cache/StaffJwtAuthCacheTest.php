<?php
namespace Sdk\User\Staff\Cache;

use PHPUnit\Framework\TestCase;

class StaffJwtAuthCacheTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StaffJwtAuthCacheMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsCache()
    {
        $this->assertInstanceOf(
            'Marmot\Framework\Classes\Cache',
            $this->stub
        );
    }

    public function testGetKey()
    {
        $this->assertEquals(StaffJwtAuthCache::KEY, $this->stub->getKey());
    }
}
