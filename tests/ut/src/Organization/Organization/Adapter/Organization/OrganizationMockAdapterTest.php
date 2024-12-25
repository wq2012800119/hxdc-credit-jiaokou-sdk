<?php
namespace Sdk\Organization\Organization\Adapter\Organization;

use PHPUnit\Framework\TestCase;

class OrganizationMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIOrganizationAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Adapter\Organization\IOrganizationAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->stub->fetchObject(1)
        );
    }
}
