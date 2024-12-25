<?php
namespace Sdk\CreditModule\Copyright\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Copyright\Model\Copyright;
use Sdk\CreditModule\Copyright\Model\NullCopyright;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class CopyrightTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullCopyright::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($copyright, array $keys = array())
    {
        if (!$copyright instanceof Copyright) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'title',
                'registrationNumber',
                'conditions',
                'registrationDate',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($copyright->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $copyright->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $copyright->getUnifiedIdentifier();
        }
        if (in_array('title', $keys)) {
            $expression['title'] = $copyright->getTitle();
        }
        if (in_array('registrationNumber', $keys)) {
            $expression['registrationNumber'] = $copyright->getRegistrationNumber();
        }
        if (in_array('conditions', $keys)) {
            $expression['conditions'] = $copyright->getConditions();
        }
        if (in_array('registrationDate', $keys)) {
            $expression['registrationDate'] = $copyright->getRegistrationDate();
            $expression['registrationDateFormatConvert'] = date('Y-m-d', $copyright->getRegistrationDate());
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $copyright->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($copyright, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $copyright->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $copyright->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $copyright->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $copyright->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Copyright $copyright, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $copyright->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $copyright->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
