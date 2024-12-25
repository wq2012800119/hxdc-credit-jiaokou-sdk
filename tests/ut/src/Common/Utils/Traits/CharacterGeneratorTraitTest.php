<?php
namespace Sdk\Common\Utils\Traits;

use PHPUnit\Framework\TestCase;

class CharacterGeneratorTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CharacterGeneratorTraitMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testRandomChar()
    {
        $result = $this->stub->randomCharPublic();

        $this->assertIsString($result);
    }
}
