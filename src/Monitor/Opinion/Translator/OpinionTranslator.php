<?php
namespace Sdk\Monitor\Opinion\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Monitor\Opinion\Model\Opinion;
use Sdk\Monitor\Opinion\Model\NullOpinion;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class OpinionTranslator implements ITranslator
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
        return NullOpinion::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($opinion, array $keys = array())
    {
        if (!$opinion instanceof Opinion) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'keyword',
                'category',
                'source',
                'pubDate',
                'content',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($opinion->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $opinion->getName();
        }
        if (in_array('keyword', $keys)) {
            $expression['keyword'] = $opinion->getKeyword();
        }
        if (in_array('category', $keys)) {
            $expression['category'] = $this->typeFormatConversion(
                $opinion->getCategory(),
                Opinion::CATEGORY_CN
            );
        }
        if (in_array('source', $keys)) {
            $expression['source'] = $this->typeFormatConversion(
                $opinion->getSource(),
                Opinion::SOURCE_CN
            );
        }
        if (in_array('pubDate', $keys)) {
            $expression['pubDate'] = $opinion->getPubDate();
            $expression['pubDateFormatConvert'] = date('Y-m-d', $opinion->getPubDate());
        }
        if (in_array('content', $keys)) {
            $expression['content'] = $opinion->getContent();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $opinion->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $opinion->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $opinion->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $opinion->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $opinion->getUpdateTime());
        }

        $expression = $this->relationObjectToArray($opinion, $keys, $expression);

        return $expression;
    }

    protected function relationObjectToArray(Opinion $opinion, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $opinion->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $opinion->getOrganization(),
                $keys['organization']
            );
        }

        return $expression;
    }
}
