<?php
namespace Sdk\User\Staff\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class SuperUserStaffTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SuperUserStaff();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsStaff()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->stub
        );
    }
    
    public function operation(string $method)
    {
        $result = $this->stub->$method();

        $this->assertFalse($result);
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testInsert()
    {
        $this->operation('insert');
    }

    public function testUpdate()
    {
        $this->operation('update');
    }

    public function testEnable()
    {
        $this->operation('enable');
    }

    public function testDisable()
    {
        $this->operation('disable');
    }
}
