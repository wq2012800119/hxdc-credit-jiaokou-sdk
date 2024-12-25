<?php
namespace Sdk\Role\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Role\Purview\Model\IPurviewAble;

class RoleWidgetRuleTest extends TestCase
{

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RoleWidgetRule();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //purview
    /**
     * @dataProvider additionProviderPurview
     */
    public function testPurview($parameter, $expected)
    {
        $result = $this->stub->purview($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ROLE_PURVIEW_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderPurview()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array(array($faker->title()), false),
            array(array('id' => '1', 'actions' => 'aaa'), false),
            array(array(array('id' => IPurviewAble::COLUMN['ORGANIZATION'], 'actions' => 'actions')), false),
            array(array(array('id' => 1000000000, 'actions' => 11111)), false),
            array(array(array('id' => IPurviewAble::COLUMN['ORGANIZATION'], 'actions' => 1)), true),
        );
    }
}
