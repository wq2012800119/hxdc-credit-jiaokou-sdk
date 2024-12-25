<?php
namespace Sdk\User\Staff\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\Staff;

class StaffWidgetRuleTest extends TestCase
{

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StaffWidgetRule();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //roles
    /**
     * @dataProvider additionProviderRoles
     */
    public function testRoles($parameter, $expected)
    {
        $result = $this->stub->roles($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(STAFF_ROLES_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderRoles()
    {
        return array(
            array('', false),
            array(array('a'), false),
            array(array(1, 2), true)
        );
    }

    //category
    /**
     * @dataProvider additionProviderCategory
     */
    public function testCategory($parameter, $expected)
    {
        $result = $this->stub->category($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(STAFF_CATEGORY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderCategory()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Staff::CATEGORY['ORGANIZATION_USER'], true),
        );
    }
}
