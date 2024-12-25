<?php
namespace Sdk\User\Member\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\User\Member\Utils\MockObjectGenerate;
use Sdk\User\Member\Utils\TranslatorUtilsTrait;

class MemberRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new MemberRestfulTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIRestfulTranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\IRestfulTranslator',
            $this->stub
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\User\Member\Model\NullMember',
            $result
        );
    }

    public function testArrayToObject()
    {
        $member = MockObjectGenerate::generateMember(1);

        $expression['data']['id'] = $member->getId();
        $expression['data']['attributes']['subjectName'] = $member->getSubjectName();
        $expression['data']['attributes']['cellphone'] = $member->getCellphone();
        $expression['data']['attributes']['idCard'] = $member->getIdCard();
        $expression['data']['attributes']['password'] = $member->getPassword();
        $expression['data']['attributes']['gender'] = $member->getGender();
        $expression['data']['attributes']['email'] = $member->getEmail();
        $expression['data']['attributes']['address'] = $member->getAddress();
        $expression['data']['attributes']['question'] = $member->getQuestion();
        $expression['data']['attributes']['answer'] = $member->getAnswer();
        $expression['data']['attributes']['status'] = $member->getStatus();
        $expression['data']['attributes']['statusTime'] = $member->getStatusTime();
        $expression['data']['attributes']['createTime'] = $member->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $member->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\User\Member\Model\Member',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testObjectToArrayEmpty()
    {
        $member = array();
        $result = $this->stub->objectToArray($member);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $member = MockObjectGenerate::generateMember(1);

        $result = $this->stub->objectToArray($member);
        $this->compareRestfulTranslatorEquals($member, $result);
    }
}
