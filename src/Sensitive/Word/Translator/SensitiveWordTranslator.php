<?php
namespace Sdk\Sensitive\Word\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Sensitive\Word\Model\SensitiveWord;
use Sdk\Sensitive\Word\Model\NullSensitiveWord;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class SensitiveWordTranslator implements ITranslator
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
        return NullSensitiveWord::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($sensitiveWord, array $keys = array())
    {
        if (!$sensitiveWord instanceof SensitiveWord) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'source',
                'remark',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($sensitiveWord->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $sensitiveWord->getName();
        }
        if (in_array('source', $keys)) {
            $expression['source'] = $sensitiveWord->getSource();
        }
        if (in_array('remark', $keys)) {
            $expression['remark'] = $sensitiveWord->getRemark();
        }
        
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $sensitiveWord->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($sensitiveWord, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $sensitiveWord->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $sensitiveWord->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $sensitiveWord->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $sensitiveWord->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(SensitiveWord $sensitiveWord, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $sensitiveWord->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $sensitiveWord->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
