<?php
namespace Sdk\User\Member\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Model\NullMember;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class MemberRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $member = null)
    {
        if (empty($expression)) {
            return NullMember::getInstance();
        }

        if ($member == null) {
            $member = new Member();
        }

        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();

        if (isset($data['id'])) {
            $member->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $member->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['cellphone'])) {
            $member->setCellphone($attributes['cellphone']);
        }
        if (isset($attributes['idCard'])) {
            $member->setIdCard($attributes['idCard']);
        }
        if (isset($attributes['password'])) {
            $member->setPassword($attributes['password']);
        }
        if (isset($attributes['gender'])) {
            $member->setGender($attributes['gender']);
        }
        if (isset($attributes['email'])) {
            $member->setEmail($attributes['email']);
        }
        if (isset($attributes['address'])) {
            $member->setAddress($attributes['address']);
        }
        if (isset($attributes['question'])) {
            $member->setQuestion($attributes['question']);
        }
        if (isset($attributes['answer'])) {
            $member->setAnswer($attributes['answer']);
        }
        if (isset($attributes['certificate'])) {
            $member->setCertificate($attributes['certificate']);
        }
        if (isset($attributes['status'])) {
            $member->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $member->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $member->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $member->setUpdateTime($attributes['updateTime']);
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
                'idCard',
                'password',
                'oldPassword',
                'gender',
                'email',
                'address',
                'question',
                'answer'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'members'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $member->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $member->getSubjectName();
        }
        if (in_array('cellphone', $keys)) {
            $attributes['cellphone'] = $member->getCellphone();
        }
        if (in_array('idCard', $keys)) {
            $attributes['idCard'] = $member->getIdCard();
        }
        if (in_array('password', $keys)) {
            $attributes['password'] = $member->getPassword();
        }
        if (in_array('oldPassword', $keys)) {
            $attributes['oldPassword'] = $member->getOldPassword();
        }
        if (in_array('gender', $keys)) {
            $attributes['gender'] = $member->getGender();
        }
        if (in_array('email', $keys)) {
            $attributes['email'] = $member->getEmail();
        }
        if (in_array('address', $keys)) {
            $attributes['address'] = $member->getAddress();
        }
        if (in_array('question', $keys)) {
            $attributes['question'] = $member->getQuestion();
        }
        if (in_array('answer', $keys)) {
            $attributes['answer'] = $member->getAnswer();
        }
        
        $expression['data']['attributes'] = $attributes;

        return $expression;
    }
}
