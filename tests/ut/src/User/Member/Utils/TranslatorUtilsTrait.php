<?php
namespace Sdk\User\Member\Utils;

use Sdk\User\Member\Model\Member;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Member $member, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $member->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['subjectName'])) {
            $this->assertEquals($attributes['subjectName'], $member->getSubjectName());
        }
        if (isset($attributes['cellphone'])) {
            $this->assertEquals($attributes['cellphone'], $member->getCellphone());
        }
        if (isset($attributes['idCard'])) {
            $this->assertEquals($attributes['idCard'], $member->getIdCard());
        }
        if (isset($attributes['password'])) {
            $this->assertEquals($attributes['password'], $member->getPassword());
        }
        if (isset($attributes['oldPassword'])) {
            $this->assertEquals($attributes['oldPassword'], $member->getOldPassword());
        }
        if (isset($attributes['gender'])) {
            $this->assertEquals($attributes['gender'], $member->getGender());
        }
        if (isset($attributes['email'])) {
            $this->assertEquals($attributes['email'], $member->getEmail());
        }
        if (isset($attributes['address'])) {
            $this->assertEquals($attributes['address'], $member->getAddress());
        }
        if (isset($attributes['question'])) {
            $this->assertEquals($attributes['question'], $member->getQuestion());
        }
        if (isset($attributes['answer'])) {
            $this->assertEquals($attributes['answer'], $member->getAnswer());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $member->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $member->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $member->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $member->getUpdateTime());
        }
    }

    public function compareTranslatorEquals(array $expression, Member $member)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($member->getId()));
        }
        if (isset($expression['subjectName'])) {
            $this->assertEquals($expression['subjectName'], $member->getSubjectName());
        }
        if (isset($expression['cellphone'])) {
            $this->assertEquals($expression['cellphone'], $member->getCellphone());
        }
        if (isset($expression['identification'])) {
            $this->assertEquals($expression['identification'], $member->getIdentification());
        }
        if (isset($expression['idCard'])) {
            $this->assertEquals($expression['idCard'], $member->getIdCard());
        }
        if (isset($expression['email'])) {
            $this->assertEquals($expression['email'], $member->getEmail());
        }
        if (isset($expression['address'])) {
            $this->assertEquals($expression['address'], $member->getAddress());
        }
        if (isset($expression['answer'])) {
            $this->assertEquals($expression['answer'], $member->getAnswer());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $member->getCreateTime());
        }
        if (isset($expression['createTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $member->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $member->getUpdateTime());
        }
        if (isset($expression['updateTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $member->getUpdateTime())
            );
        }
    }
}
