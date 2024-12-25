<?php
namespace Sdk\Rap\Memorandum\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Rap\Memorandum\Model\Memorandum;
use Sdk\Rap\Memorandum\Model\NullMemorandum;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class MemorandumTranslator implements ITranslator
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
        return NullMemorandum::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($memorandum, array $keys = array())
    {
        if (!$memorandum instanceof Memorandum) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'documentNo',
                'originatingUnit',
                'releaseDate',
                'rewardType',
                'jointSigningDepartment',
                'content',
                'attachments',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($memorandum->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $memorandum->getName();
        }
        if (in_array('documentNo', $keys)) {
            $expression['documentNo'] = $memorandum->getDocumentNo();
        }
        if (in_array('originatingUnit', $keys)) {
            $expression['originatingUnit'] = $memorandum->getOriginatingUnit();
        }
        if (in_array('releaseDate', $keys)) {
            $expression['releaseDate'] = $memorandum->getReleaseDate();
            $expression['releaseDateFormatConvert'] = date('Y-m-d', $memorandum->getReleaseDate());
        }
        if (in_array('rewardType', $keys)) {
            $expression['rewardType'] = $this->typeFormatConversion(
                $memorandum->getRewardType(),
                Memorandum::REWARD_TYPE_CN
            );
        }
        if (in_array('jointSigningDepartment', $keys)) {
            $expression['jointSigningDepartment'] = $memorandum->getJointSigningDepartment();
        }
        if (in_array('content', $keys)) {
            $expression['content'] = $memorandum->getContent();
        }
        if (in_array('attachments', $keys)) {
            $expression['attachments'] = $memorandum->getAttachments();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $memorandum->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $memorandum->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $memorandum->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $memorandum->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $memorandum->getUpdateTime());
        }

        $expression = $this->relationObjectToArray($memorandum, $keys, $expression);

        return $expression;
    }

    protected function relationObjectToArray(Memorandum $memorandum, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $memorandum->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $memorandum->getOrganization(),
                $keys['organization']
            );
        }

        return $expression;
    }
}
