<?php
namespace Sdk\Organization\Organization\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

class OrganizationWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationWidgetRule();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //shortName
    /**
     * @dataProvider additionProviderShortName
     */
    public function testShortName($parameter, $expected)
    {
        $result = $this->stub->shortName($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ORGANIZATION_SHORT_NAME_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderShortName()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(OrganizationWidgetRule::SHORT_NAME_MIN_LENGTH), true),
            array($this->randomChar(OrganizationWidgetRule::SHORT_NAME_MIN_LENGTH-1), false),
            array($this->randomChar(OrganizationWidgetRule::SHORT_NAME_MAX_LENGTH), true),
            array($this->randomChar(OrganizationWidgetRule::SHORT_NAME_MAX_LENGTH+1), false)
        );
    }
}
