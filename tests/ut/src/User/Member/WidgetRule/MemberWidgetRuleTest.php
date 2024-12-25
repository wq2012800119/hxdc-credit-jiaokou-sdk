<?php
namespace Sdk\User\Member\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

use Sdk\User\Member\Model\Member;

class MemberWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new MemberWidgetRule();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //gender
    /**
     * @dataProvider additionProviderGender
     */
    public function testGender($parameter, $expected)
    {
        $result = $this->stub->gender($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(MEMBER_GENDER_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderGender()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Member::GENDER['MALE'], true),
        );
    }

    //question
    /**
     * @dataProvider additionProviderQuestion
     */
    public function testQuestion($parameter, $expected)
    {
        $result = $this->stub->question($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(MEMBER_QUESTION_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderQuestion()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Member::QUESTION['QUESTION_ONE_FAVORITE_COLOR'], true),
        );
    }

    //email
    /**
     * @dataProvider additionProviderEmail
     */
    public function testEmail($parameter, $expected)
    {
        $result = $this->stub->email($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(MEMBER_EMAIL_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderEmail()
    {
        return array(
            array('', false),
            array(array(1), false),
            array('997934308@qq.com', true),
        );
    }
        
    //address
    /**
     * @dataProvider additionProviderAddress
     */
    public function testAddress($parameter, $expected)
    {
        $result = $this->stub->address($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(MEMBER_ADDRESS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderAddress()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(MemberWidgetRule::ADDRESS_MIN_LENGTH), true),
            array($this->randomChar(MemberWidgetRule::ADDRESS_MIN_LENGTH-1), false),
            array($this->randomChar(MemberWidgetRule::ADDRESS_MAX_LENGTH), true),
            array($this->randomChar(MemberWidgetRule::ADDRESS_MAX_LENGTH+1), false)
        );
    }
      
    //answer
    /**
     * @dataProvider additionProviderAnswer
     */
    public function testAnswer($parameter, $expected)
    {
        $result = $this->stub->answer($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(MEMBER_ANSWER_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderAnswer()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(MemberWidgetRule::ANSWER_MIN_LENGTH), true),
            array($this->randomChar(MemberWidgetRule::ANSWER_MIN_LENGTH-1), false),
            array($this->randomChar(MemberWidgetRule::ANSWER_MAX_LENGTH), true),
            array($this->randomChar(MemberWidgetRule::ANSWER_MAX_LENGTH+1), false)
        );
    }
}
