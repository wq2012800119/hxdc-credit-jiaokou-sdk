<?php
namespace Sdk\Common\Utils;

use PHPUnit\Framework\TestCase;

class CommonSessionTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CommonSessionMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsSession()
    {
        $this->assertInstanceOf(
            'Marmot\Framework\Classes\Session',
            $this->stub
        );
    }

    public function testGetKey()
    {
        $this->assertEquals(CommonSession::KEY, $this->stub->getKey());
    }
}
