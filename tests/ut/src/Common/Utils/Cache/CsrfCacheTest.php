<?php
namespace Sdk\Common\Utils\Cache;

use PHPUnit\Framework\TestCase;

class CsrfCacheTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CsrfCacheMock();
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
        $this->assertEquals(CsrfCache::KEY, $this->stub->getKey());
    }
}
