<?php
namespace Sdk\Role\Purview\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;

class PurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(PurviewMock::class)
                    ->setMethods(['fetchStaffPurview', 'getColumn'])
                    ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIPurviewAble()
    {
        $stub = new PurviewMock();
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\IPurviewAble',
            $stub
        );
    }

    public function testGetColumn()
    {
        $stub = new PurviewMock();
        $this->assertIsInt($stub->getColumn());
    }

    public function testFetch()
    {
        $column = 1;
        $staffPurview = array($column => array($column));
        $this->stub->expects($this->exactly(1))->method('fetchStaffPurview')->willReturn($staffPurview);
        $this->stub->expects($this->exactly(1))->method('getColumn')->willReturn($column);

        $result = $this->stub->fetch();

        $this->assertTrue($result);
    }

    public function testOperationColumnTrue()
    {
        $method = 'add';
        $column = IPurviewAble::COLUMN['ROLE'];
        $staffPurview = array($column => array(1));
        $this->stub->expects($this->exactly(1))->method('fetchStaffPurview')->willReturn($staffPurview);
        $this->stub->expects($this->exactly(1))->method('getColumn')->willReturn($column);

        $result = $this->stub->operationPublic($method);

        $this->assertTrue($result);
    }

    public function testOperationColumnFalse()
    {
        $method = 'test';
        $column = IPurviewAble::COLUMN['ROLE'];
        $staffPurview = array($column => array(1));
        $this->stub->expects($this->exactly(1))->method('fetchStaffPurview')->willReturn($staffPurview);

        $result = $this->stub->operationPublic($method, $column);

        $this->assertFalse($result);
    }

    public function testFetchStaffPurview()
    {
        $staffPurview = array(1 => array(1));

        $staff = new OrganizationUserStaff(1);
        $staff->setPurview($staffPurview);
        
        Core::$container->set('staff', $staff);

        $result = $this->stub->fetchStaffPurviewPublic();

        $this->assertEquals($result, $staffPurview);
    }
}
