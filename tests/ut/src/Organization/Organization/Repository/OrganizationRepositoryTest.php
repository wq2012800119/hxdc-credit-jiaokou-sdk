<?php
namespace Sdk\Organization\Organization\Repository;

use PHPUnit\Framework\TestCase;

class OrganizationRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationRepository();
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

    public function testExtendsCommonRepository()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Repository\CommonRepository',
            $this->stub
        );
    }

    public function testGetActualAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Adapter\Organization\OrganizationRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Adapter\Organization\OrganizationMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
