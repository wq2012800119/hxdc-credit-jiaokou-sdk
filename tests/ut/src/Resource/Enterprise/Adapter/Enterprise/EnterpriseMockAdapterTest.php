<?php
namespace Sdk\Resource\Enterprise\Adapter\Enterprise;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Enterprise\Model\Enterprise;

class EnterpriseMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new EnterpriseMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIEnterpriseAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Adapter\Enterprise\IEnterpriseAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Model\Enterprise',
            $this->stub->fetchObject(1)
        );
    }

    public function testAuthorize()
    {
        $enterprise = new Enterprise(1);

        $this->assertTrue($this->stub->authorize($enterprise));
    }

    public function testUnAuthorize()
    {
        $enterprise = new Enterprise(1);

        $this->assertTrue($this->stub->unAuthorize($enterprise));
    }
}
