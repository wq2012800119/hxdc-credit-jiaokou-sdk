<?php
namespace Sdk\CreditModule\Certification\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Certification\Model\Certification;
use Sdk\CreditModule\Certification\Model\NullCertification;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class CertificationTranslator implements ITranslator
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
        return NullCertification::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($certification, array $keys = array())
    {
        if (!$certification instanceof Certification) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'name',
                'pubDate',
                'validateDate',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($certification->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $certification->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $certification->getUnifiedIdentifier();
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $certification->getName();
        }
        if (in_array('pubDate', $keys)) {
            $expression['pubDate'] = $certification->getPubDate();
            $expression['pubDateFormatConvert'] = date('Y-m-d', $certification->getPubDate());
        }
        if (in_array('validateDate', $keys)) {
            $expression['validateDate'] = $certification->getValidateDate();
            $expression['validateDateFormatConvert'] = date('Y-m-d', $certification->getValidateDate());
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $certification->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($certification, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $certification->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $certification->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $certification->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $certification->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Certification $certification, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $certification->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $certification->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
