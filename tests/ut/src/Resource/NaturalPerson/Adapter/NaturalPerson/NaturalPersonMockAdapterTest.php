<?php
namespace Sdk\Resource\NaturalPerson\Adapter\NaturalPerson;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;

class NaturalPersonMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new NaturalPersonMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINaturalPersonAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\INaturalPersonAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Model\NaturalPerson',
            $this->stub->fetchObject(1)
        );
    }

    public function testAuthorize()
    {
        $naturalPerson = new NaturalPerson(1);

        $this->assertTrue($this->stub->authorize($naturalPerson));
    }

    public function testUnAuthorize()
    {
        $naturalPerson = new NaturalPerson(1);

        $this->assertTrue($this->stub->unAuthorize($naturalPerson));
    }
}
