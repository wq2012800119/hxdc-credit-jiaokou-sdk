<?php
namespace Sdk\User\Member\Cache;

use PHPUnit\Framework\TestCase;

class MemberCookieAuthCacheTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new MemberCookieAuthCacheMock();
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
        $this->assertEquals(MemberCookieAuthCache::KEY, $this->stub->getKey());
    }
}
