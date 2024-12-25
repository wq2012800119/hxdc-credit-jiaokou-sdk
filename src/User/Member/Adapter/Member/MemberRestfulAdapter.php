<?php
namespace Sdk\User\Member\Adapter\Member;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Model\NullMember;
use Sdk\User\Member\Translator\MemberRestfulTranslator;

class MemberRestfulAdapter extends CommonRestfulAdapter implements IMemberAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => SUBJECT_NAME_FORMAT_INCORRECT,
            'idCard' => ID_CARD_FORMAT_INCORRECT,
            'cellphone' => CELLPHONE_FORMAT_INCORRECT,
            'password' => PASSWORD_FORMAT_INCORRECT,
            'gender' => MEMBER_GENDER_FORMAT_INCORRECT,
            'email' => MEMBER_EMAIL_FORMAT_INCORRECT,
            'address' => MEMBER_ADDRESS_FORMAT_INCORRECT,
            'question' => MEMBER_QUESTION_FORMAT_INCORRECT,
            'answer' => MEMBER_ANSWER_FORMAT_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'cellphone' => MEMBER_CELLPHONE_EXISTS,
            'idCard' => MEMBER_ID_CARD_EXISTS,
        ),
        100004 => array(
            'member' => ACCOUNT_PASSWORD_INCORRECT,
            'oldPassword' => OLD_PASSWORD_INCORRECT,
            'answer' => MEMBER_ANSWER_INCORRECT
        )
    );
    
    const SCENARIOS = [
        'MEMBER_LIST'=>[
            'fields' => [
                'member'=>'subjectName,cellphone,idCard,gender,status,updateTime',
            ],
            'include' => ''
        ],
        'MEMBER_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new MemberRestfulTranslator(),
            'members',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullMember::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    protected function insertTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'cellphone',
            'idCard',
            'password',
            'gender',
            'email',
            'address',
            'question',
            'answer'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'gender',
            'email',
            'address'
        );
    }

    public function login(Member $member) : bool
    {
        $data = $this->getTranslator()->objectToArray($member, array('cellphone', 'password'));
       
        $this->post(
            $this->getResource().'/login',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($member);
            return true;
        }

        return false;
    }

    public function validateAnswer(Member $member) : bool
    {
        $data = $this->getTranslator()->objectToArray($member, array('answer'));
       
        $this->post(
            $this->getResource().'/'.$member->getId().'/validateAnswer',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($member);
            return true;
        }

        return false;
    }

    public function resetPassword(Member $member) : bool
    {
        $data = $this->getTranslator()->objectToArray($member, array('password'));
       
        $this->patch(
            $this->getResource().'/'.$member->getId().'/resetPassword',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($member);
            return true;
        }

        return false;
    }

    public function updatePassword(Member $member) : bool
    {
        $data = $this->getTranslator()->objectToArray($member, array('password', 'oldPassword'));
       
        $this->patch(
            $this->getResource().'/'.$member->getId().'/password',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($member);
            return true;
        }

        return false;
    }

    public function updateSecurityQuestion(Member $member) : bool
    {
        $data = $this->getTranslator()->objectToArray($member, array('question', 'answer'));
       
        $this->patch(
            $this->getResource().'/'.$member->getId().'/securityQuestion',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($member);
            return true;
        }

        return false;
    }
}
