<?php
namespace Sdk\User\Member\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Utils\MockObjectGenerate;
use Sdk\User\Member\Utils\TranslatorUtilsTrait;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MemberTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new MemberTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsITranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\ITranslator',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $stub = new MemberTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\User\Member\Model\NullMember',
            $stub->getNullObjectPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $expression = array();
        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\User\Member\Model\NullMember',
            $result
        );
    }

    public function testArrayToObject()
    {
        $member = MockObjectGenerate::generateMember(1);

        $expression['id'] = marmot_encode($member->getId());
        $expression['subjectName'] = $member->getSubjectName();
        $expression['cellphone'] = $member->getCellphone();
        $expression['idCard'] = $member->getIdCard();
        $expression['identification'] = $member->getIdentification();
        $expression['gender']['id'] = marmot_encode($member->getGender());
        $expression['email'] = $member->getEmail();
        $expression['address'] = $member->getAddress();
        $expression['question']['id'] = marmot_encode($member->getQuestion());
        $expression['answer'] = $member->getAnswer();
        $expression['status']['id'] = marmot_encode($member->getStatus());
        $expression['statusTime'] = $member->getStatusTime();
        $expression['createTime'] = $member->getCreateTime();
        $expression['updateTime'] = $member->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\User\Member\Model\Member',
            $result
        );

        $this->compareTranslatorEquals($expression, $result);
    }

    public function testObjectToArrayEmpty()
    {
        $member = array();
        $result = $this->stub->objectToArray($member);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(MemberTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'idCardDataDesensitization',
                               'cellphoneDataDesensitization'
                            ])->getMock();

        $member = MockObjectGenerate::generateMember(1);

        list($genderArray, $questionArray) = $this->typeFormatConversion($member, $stub);
        $statusArray = $this->statusFormatConversion($member, $stub);
        $idCardDesensitization = $this->idCardDataDesensitization($member, $stub);
        $cellphoneDataDesensitization = $this->cellphoneDataDesensitization($member, $stub);
        $result = $stub->objectToArray($member);

        $this->assertEquals($result['gender'], $genderArray);
        $this->assertEquals($result['question'], $questionArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['idCardDesensitization'], $idCardDesensitization);
        $this->assertEquals($result['cellphoneDesensitization'], $cellphoneDataDesensitization);
        
        $this->compareTranslatorEquals($result, $member);
    }

    private function cellphoneDataDesensitization(Member $member, $stub) : string
    {
        $cellphoneDesensitization = '137****3456';

        $stub->expects($this->exactly(1))->method(
            'cellphoneDataDesensitization'
        )->with($member->getCellphone())->willReturn($cellphoneDesensitization);

        return $cellphoneDesensitization;
    }

    private function idCardDataDesensitization(Member $member, $stub) : string
    {
        $idCardDesensitization = '4128**********5763';

        $stub->expects($this->exactly(1))->method(
            'idCardDataDesensitization'
        )->with($member->getIdCard())->willReturn($idCardDesensitization);

        return $idCardDesensitization;
    }

    private function typeFormatConversion(Member $member, $stub) : array
    {
        $genderArray = array('gender');
        $questionArray = array('question');

        $stub->expects($this->exactly(2))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $member->getGender(), Member::GENDER_CN, $genderArray
                ],
                [
                    $member->getQuestion(), Member::QUESTION_CN, $questionArray
                ],
            ]));

        return [$genderArray, $questionArray];
    }

    private function statusFormatConversion(Member $member, $stub) : array
    {
        $statusArray = array('status');

        $stub->expects($this->exactly(1))->method(
            'statusFormatConversion'
        )->with($member->getStatus())->willReturn($statusArray);

        return $statusArray;
    }
}
