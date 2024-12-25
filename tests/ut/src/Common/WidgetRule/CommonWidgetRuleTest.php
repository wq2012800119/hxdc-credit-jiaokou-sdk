<?php
namespace Sdk\Common\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class CommonWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CommonWidgetRule();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //routeId
    /**
     * @dataProvider additionProviderRouteId
     */
    public function testRouteId($parameter, $expected)
    {
        $result = $this->stub->routeId($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ROUTE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function additionProviderRouteId()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array($faker->title(), false),
            array($faker->randomNumber(2), true)
        );
    }

    //isArrayType
    /**
     * @dataProvider additionProviderIsArrayType
     */
    public function testIsArrayType($parameter, $expected, $pointer)
    {
        $result = $this->stub->isArrayType($parameter, $pointer);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PARAMETER_FORMAT_ERROR, Core::getLastError()->getId());
        $this->assertEquals(array('pointer' => $pointer), Core::getLastError()->getSource());
    }

    public function additionProviderIsArrayType()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array($faker->title(), false, 'string'),
            array($faker->randomNumber(), false, 'number'),
            array($faker->shuffle([1,2,3,4]), true, 'array')
        );
    }

    //isStringType
    /**
     * @dataProvider additionProviderIsStringType
     */
    public function testIsStringType($parameter, $expected, $pointer)
    {
        $result = $this->stub->isStringType($parameter, $pointer);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PARAMETER_FORMAT_ERROR, Core::getLastError()->getId());
        $this->assertEquals(array('pointer' => $pointer), Core::getLastError()->getSource());
    }

    public function additionProviderIsStringType()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array($faker->title(), true, 'string'),
            array($faker->randomNumber(), false, 'number'),
            array($faker->shuffle([1,2,3,4]), false, 'array')
        );
    }

    //isNumericType
    /**
     * @dataProvider additionProviderIsNumericType
     */
    public function testIsNumericType($parameter, $expected, $pointer)
    {
        $result = $this->stub->isNumericType($parameter, $pointer);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PARAMETER_FORMAT_ERROR, Core::getLastError()->getId());
        $this->assertEquals(array('pointer' => $pointer), Core::getLastError()->getSource());
    }

    public function additionProviderIsNumericType()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array($faker->title(), false, 'string'),
            array($faker->randomNumber(), true, 'number'),
            array($faker->shuffle([1,2,3,4]), false, 'array')
        );
    }
    
    //title
    /**
     * @dataProvider additionProviderTitle
     */
    public function testTitle($parameter, $expected)
    {
        $result = $this->stub->title($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(TITLE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTitle()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::TITLE_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::TITLE_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::TITLE_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::TITLE_MAX_LENGTH+1), false)
        );
    }

    //name
    /**
     * @dataProvider additionProviderName
     */
    public function testName($parameter, $expected)
    {
        $result = $this->stub->name($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(NAME_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderName()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::NAME_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::NAME_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::NAME_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::NAME_MAX_LENGTH+1), false)
        );
    }

    //subjectName
    /**
     * @dataProvider additionProviderSubjectName
     */
    public function testSubjectName($parameter, $expected)
    {
        $result = $this->stub->subjectName($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(SUBJECT_NAME_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSubjectName()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::SUBJECT_NAME_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::SUBJECT_NAME_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::SUBJECT_NAME_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::SUBJECT_NAME_MAX_LENGTH+1), false)
        );
    }

    //unifiedIdentifier
    /**
     * @dataProvider additionProviderUnifiedIdentifier
     */
    public function testUnifiedIdentifier($parameter, $expected)
    {
        $result = $this->stub->unifiedIdentifier($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(UNIFIED_IDENTIFIER_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderUnifiedIdentifier()
    {
        return array(
            array('00000000000000000X', true),
            array('123456789012345678', true),
            array($this->randomChar(CommonWidgetRule::UNIFIED_IDENTIFIER_LENGTH-1), false), //长度小于18
            array('IOSVZ0000000000000', false), //不符合验证规则
            array('123456789012345679', false), //符合验证规则,但最后一位验证失败
        );
    }

    //idCard
    /**
     * @dataProvider additionProviderIdCard
     */
    public function testIdCard($parameter, $expected)
    {
        $result = $this->stub->idCard($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ID_CARD_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderIdCard()
    {
        return array(
            array('X12345239810306780', false), // 不符合正则表达式
            array('422825931222575', true), //15位身份证号
            array('422825199312225754', true), //18位身份证号
            array('102825199312225754', false), //地址不正确
            array('422825199312225759', false) //符合验证规则,但最后一位验证失败
        );
    }

    //checkBirthDayCode
    /**
     * @dataProvider additionProviderCheckBirthDayCode
     */
    public function testCheckBirthDayCode($parameter, $expected)
    {
        $stub = new CommonWidgetRuleMock();
        
        $result = $stub->checkBirthDayCodePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
    }

    public function additionProviderCheckBirthDayCode()
    {
        $date = date('Ymd', strtotime('+1 day'));
        return array(
            array('422825199312225754', true), //18位身份证号
            array('422825199322225754', false), //不符合正则表达式
            array('422825'.$date.'25754', false) //大于当前时间
        );
    }
    
    public function testConvertIDCard15to18()
    {
        $stub = new CommonWidgetRuleMock();
        $idCard = '1290934567';
        $result = $stub->convertIDCard15to18Public($idCard);

        $this->assertEquals($idCard, $result);
    }

    //cellphone
    /**
     * @dataProvider additionProviderCellphone
     */
    public function testCellphone($parameter, $expected)
    {
        $result = $this->stub->cellphone($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(CELLPHONE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderCellphone()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->regexify('/^[1][0-9]{3}$/'), false),
            array($faker->regexify('/^[1][0-9]{10}$/'), true),
            array($faker->regexify('/^[1][0-9]{13}$/'), false),
        );
    }

    //telephone
    /**
     * @dataProvider additionProviderTelephone
     */
    public function testTelephone($parameter, $expected)
    {
        $result = $this->stub->telephone($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(TELEPHONE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTelephone()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::TELEPHONE_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::TELEPHONE_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::TELEPHONE_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::TELEPHONE_MAX_LENGTH+1), false)
        );
    }

    //password
    /**
     * @dataProvider additionProviderPassword
     */
    public function testPassword($parameter, $expected)
    {
        $result = $this->stub->password($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PASSWORD_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderPassword()
    {
        $faker = \Faker\Factory::create('zh_CN');
        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array('Password0101#', true),
        );
    }

    //confirmPassword
    /**
     * @dataProvider additionProviderConfirmPassword
     */
    public function testConfirmPassword($parameter, $expected)
    {
        $result = $this->stub->confirmPassword($parameter['password'], $parameter['confirmPassword']);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(CONFIRM_PASSWORD_IDENTICAL_DENIED, Core::getLastError()->getId());
    }

    public function additionProviderConfirmPassword()
    {
        return array(
            array(array('password' => 'password', 'confirmPassword' => 'confirmPassword'), false),
            array(array('password' => '', 'confirmPassword' => 'confirmPassword'), false),
            array(array('password' => 'password', 'confirmPassword' => ''), false),
            array(array('password' => 'password', 'confirmPassword' => 'password'), true)
        );
    }

    //reason
    /**
     * @dataProvider additionProviderReason
     */
    public function testReason($parameter, $expected)
    {
        $result = $this->stub->reason($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(REASON_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderReason()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::REASON_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::REASON_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::REASON_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::REASON_MAX_LENGTH+1), false)
        );
    }

    //description
    /**
     * @dataProvider additionProviderDescription
     */
    public function testDescription($parameter, $expected)
    {
        $result = $this->stub->description($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DESCRIPTION_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDescription()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::DESCRIPTION_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::DESCRIPTION_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::DESCRIPTION_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::DESCRIPTION_MAX_LENGTH+1), false)
        );
    }

    //content
    /**
     * @dataProvider additionProviderContent
     */
    public function testContent($parameter, $expected)
    {
        $result = $this->stub->content($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderContent()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::CONTENT_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::CONTENT_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::CONTENT_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::CONTENT_MAX_LENGTH+1), false)
        );
    }
    
    //remark
    /**
     * @dataProvider additionProviderRemark
     */
    public function testRemark($parameter, $expected)
    {
        $result = $this->stub->remark($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(REMARK_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderRemark()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(CommonWidgetRule::REMARK_MIN_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::REMARK_MIN_LENGTH-1), false),
            array($this->randomChar(CommonWidgetRule::REMARK_MAX_LENGTH), true),
            array($this->randomChar(CommonWidgetRule::REMARK_MAX_LENGTH+1), false)
        );
    }
        
    //attachment
    /**
     * @dataProvider additionProviderAttachment
     */
    public function testAttachment($parameter, $expected)
    {
        $result = $this->stub->attachment($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ATTACHMENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderAttachment()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array(array('id'=>'id'), false),
            array(array('name'=>'name', 'address' => 'value'), false),
            array(array('name'=>'name', 'address' => 'value.jpg'), false),
            array(array('name'=>'name', 'address' => 'value.doc'), true),
        );
    }
        
    //attachments
    /**
     * @dataProvider additionProviderAttachments
     */
    public function testAttachments($parameter, $expected)
    {
        $result = $this->stub->attachments($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ATTACHMENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderAttachments()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array(array('id'=>'id'), false),
            array(array(array('id'=>'id')), false),
            array(array(array('name'=>'name', 'address' => 'value')), false),
            array(array(array('name'=>'name', 'address' => 'value.jpg')), false),
            array(array(array('name'=>'name', 'address' => 'value.docx')), true),
        );
    }

    //picture
    /**
     * @dataProvider additionProviderPicture
     */
    public function testPicture($parameter, $expected)
    {
        $result = $this->stub->picture($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PICTURE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderPicture()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array(array('name'=>'name'), false),
            array(array('name'=>'name', 'address' => 'value'), false),
            array(array('name'=>'name', 'address' => 'value.jpg'), true),
            array(array('name'=>'name', 'address' => 'value.doc'), false),
        );
    }
    
    //pictures
    /**
     * @dataProvider additionProviderPictures
     */
    public function testPictures($parameter, $expected)
    {
        $result = $this->stub->pictures($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PICTURE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderPictures()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array(array('name'=>'name'), false),
            array(array(array('name'=>'name')), false),
            array(array(array('name'=>'name', 'address' => 'value')), false),
            array(array(array('name'=>'name', 'address' => 'value.jpg')), true),
            array(array(array('name'=>'name', 'address' => 'value.doc')), false),
        );
    }

    //status
    /**
     * @dataProvider additionProviderStatus
     */
    public function testStatus($parameter, $expected)
    {
        $result = $this->stub->status($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(STATUS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderStatus()
    {
        return array(
            array('', false),
            array(array('0'), false),
            array(999999, false),
            array(IOperateAble::STATUS['ENABLED'], true),
            array(IOperateAble::STATUS['DISABLED'], true)
        );
    }
}
