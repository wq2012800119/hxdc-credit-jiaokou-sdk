<?php
namespace Sdk\CreditModule\SoftwareRight\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\SoftwareRight\Model\SoftwareRight;
use Sdk\CreditModule\SoftwareRight\Model\NullSoftwareRight;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class SoftwareRightTranslator implements ITranslator
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
        return NullSoftwareRight::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($softwareRight, array $keys = array())
    {
        if (!$softwareRight instanceof SoftwareRight) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'title',
                'version',
                'category',
                'registrationNumber',
                'registrationApprovalDate',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($softwareRight->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $softwareRight->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $softwareRight->getUnifiedIdentifier();
        }
        if (in_array('title', $keys)) {
            $expression['title'] = $softwareRight->getTitle();
        }
        if (in_array('version', $keys)) {
            $expression['version'] = $softwareRight->getVersion();
        }
        if (in_array('category', $keys)) {
            $expression['category'] = $softwareRight->getCategory();
        }
        if (in_array('registrationNumber', $keys)) {
            $expression['registrationNumber'] = $softwareRight->getRegistrationNumber();
        }
        if (in_array('registrationApprovalDate', $keys)) {
            $expression['registrationApprovalDate'] = $softwareRight->getRegistrationApprovalDate();
            $expression['registrationApprovalDateFormatConvert'] = date(
                'Y-m-d',
                $softwareRight->getRegistrationApprovalDate()
            );
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $softwareRight->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($softwareRight, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $softwareRight->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $softwareRight->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $softwareRight->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $softwareRight->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(SoftwareRight $softwareRight, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $softwareRight->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $softwareRight->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
