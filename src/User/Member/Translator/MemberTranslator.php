<?php
namespace Sdk\User\Member\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Utils\Traits\DesensitizationTrait;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Model\NullMember;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class MemberTranslator implements ITranslator
{
    use TranslatorTrait, DesensitizationTrait;

    protected function getNullObject() : INull
    {
        return NullMember::getInstance();
    }

    public function arrayToObject(array $expression, $member = null)
    {
        if (empty($expression)) {
            return $this->getNullObject();
        }
        
        if ($member == null) {
            $member = new Member();
        }

        if (isset($expression['id'])) {
            $member->setId(marmot_decode($expression['id']));
        }
        if (isset($expression['subjectName'])) {
            $member->setSubjectName($expression['subjectName']);
        }
        if (isset($expression['cellphone'])) {
            $member->setCellphone($expression['cellphone']);
        }
        if (isset($expression['idCard'])) {
            $member->setIdCard($expression['idCard']);
        }
        if (isset($expression['identification'])) {
            $member->setIdentification($expression['identification']);
        }
        if (isset($expression['gender']['id'])) {
            $member->setGender(marmot_decode($expression['gender']['id']));
        }
        if (isset($expression['email'])) {
            $member->setEmail($expression['email']);
        }
        if (isset($expression['address'])) {
            $member->setAddress($expression['address']);
        }
        if (isset($expression['question']['id'])) {
            $member->setQuestion(marmot_decode($expression['question']['id']));
        }
        if (isset($expression['certificate']['id'])) {
            $member->setCertificate(marmot_decode($expression['certificate']['id']));
        }
        if (isset($expression['answer'])) {
            $member->setAnswer($expression['answer']);
        }
        if (isset($expression['status']['id'])) {
            $member->setStatus(marmot_decode($expression['status']['id']));
        }
        if (isset($expression['createTime'])) {
            $member->setCreateTime($expression['createTime']);
        }
        if (isset($expression['updateTime'])) {
            $member->setUpdateTime($expression['updateTime']);
        }

        return $member;
    }

    public function objectToArray($member, array $keys = array())
    {
        if (!$member instanceof Member) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'cellphone',
                'identification',
                'idCard',
                'gender',
                'email',
                'address',
                'question',
                'answer',
                'certificate',
                'status',
                'createTime',
                'updateTime',
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($member->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $member->getSubjectName();
        }
        if (in_array('cellphone', $keys)) {
            $expression['cellphone'] = $member->getCellphone();
            $expression['cellphoneDesensitization'] = $this->cellphoneDataDesensitization($member->getCellphone());
        }
        if (in_array('identification', $keys)) {
            $expression['identification'] = $member->getIdentification();
        }
        if (in_array('idCard', $keys)) {
            $expression['idCard'] = $member->getIdCard();
            $expression['idCardDesensitization'] = $this->idCardDataDesensitization($member->getIdCard());
        }
        if (in_array('gender', $keys)) {
            $expression['gender'] = $this->typeFormatConversion($member->getGender(), Member::GENDER_CN);
        }
        if (in_array('email', $keys)) {
            $expression['email'] = $member->getEmail();
        }
        if (in_array('address', $keys)) {
            $expression['address'] = $member->getAddress();
        }
        if (in_array('question', $keys)) {
            $expression['question'] = $this->typeFormatConversion($member->getQuestion(), Member::QUESTION_CN);
        }
        if (in_array('certificate', $keys)) {
            $expression['certificate'] = $this->typeFormatConversion(
                $member->getCertificate(),
                Member::CERTIFICATE_CN
            );
        }
        if (in_array('answer', $keys)) {
            $expression['answer'] = $member->getAnswer();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion($member->getStatus());
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $member->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $member->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $member->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $member->getUpdateTime());
        }

        return $expression;
    }
}
