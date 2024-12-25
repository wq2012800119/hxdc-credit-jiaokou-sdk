<?php
namespace Sdk\User\Staff\Adapter\Staff;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\NullStaff;
use Sdk\User\Staff\Translator\StaffRestfulTranslator;

class StaffRestfulAdapter extends CommonRestfulAdapter implements IStaffAdapter
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
            'category' => STAFF_CATEGORY_FORMAT_INCORRECT,
            'roles' => STAFF_ROLES_FORMAT_INCORRECT,
            'organization' => STAFF_ORGANIZATION_FORMAT_INCORRECT,
            'department' => STAFF_DEPARTMENT_FORMAT_INCORRECT,
            'navigation' => STAFF_NAVIGATION_FORMAT_INCORRECT,
            'staff' => PARAMETER_INCORRECT,
            '' => PARAMETER_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => STAFF_CELLPHONE_EXISTS,
        100004 => array(
            'organization' => STAFF_ORGANIZATION_NOT_EXISTS,
            'department' => STAFF_DEPARTMENT_NOT_EXISTS,
            'roles' => STAFF_ROLES_NOT_EXISTS,
            'staff' => ACCOUNT_PASSWORD_INCORRECT, //登录
            'oldPassword' => OLD_PASSWORD_INCORRECT //修改密码
        )
    );
    
    const SCENARIOS = [
        'STAFF_LIST'=>[
            'fields' => [
                'staff'=>'subjectName,cellphone,category,organization,status,updateTime',
            ],
            'include' => 'organization,department,roles'
        ],
        'STAFF_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'organization,department,roles'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new StaffRestfulTranslator(),
            'staff',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullStaff::getInstance();
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
            'category',
            'organization',
            'department',
            'roles'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'cellphone',
            'idCard',
            'organization',
            'department',
            'roles'
        );
    }

    public function login(Staff $staff) : bool
    {
        $data = $this->getTranslator()->objectToArray($staff, array('cellphone', 'password'));
       
        $this->post(
            $this->getResource().'/login',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($staff);
            return true;
        }

        return false;
    }

    public function resetPassword(Staff $staff) : bool
    {
        $data = $this->getTranslator()->objectToArray($staff, array('password'));
       
        $this->patch(
            $this->getResource().'/'.$staff->getId().'/resetPassword',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($staff);
            return true;
        }

        return false;
    }

    public function updatePassword(Staff $staff) : bool
    {
        $data = $this->getTranslator()->objectToArray($staff, array('password', 'oldPassword'));
       
        $this->patch(
            $this->getResource().'/'.$staff->getId().'/password',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($staff);
            return true;
        }

        return false;
    }

    public function navigation(Staff $staff) : bool
    {
        $data = $this->getTranslator()->objectToArray($staff, array('navigation'));
       
        $this->patch(
            $this->getResource().'/'.$staff->getId().'/navigation',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($staff);
            return true;
        }

        return false;
    }
}
