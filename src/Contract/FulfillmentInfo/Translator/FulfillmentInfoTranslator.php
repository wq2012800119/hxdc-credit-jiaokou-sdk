<?php
namespace Sdk\Contract\FulfillmentInfo\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Contract\FulfillmentInfo\Model\FulfillmentInfo;
use Sdk\Contract\FulfillmentInfo\Model\NullFulfillmentInfo;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Contract\Performance\Translator\PerformanceTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class FulfillmentInfoTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getPerformanceTranslator() : PerformanceTranslator
    {
        return new PerformanceTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullFulfillmentInfo::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($fulfillmentInfo, array $keys = array())
    {
        if (!$fulfillmentInfo instanceof FulfillmentInfo) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'htzxjd',
                'htzjsfqezf',
                'sjlydw',
                'staff' => ['id', 'subjectName'],
                'performance' => ['id', 'htmc'],
                'organization' => ['id', 'name'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($fulfillmentInfo->getId());
        }
        if (in_array('htzxjd', $keys)) {
            $expression['htzxjd'] = $fulfillmentInfo->getHtzxjd();
        }
        if (in_array('htzjsfqezf', $keys)) {
            $expression['htzjsfqezf'] = $fulfillmentInfo->getHtzjsfqezf();
        }
        if (in_array('sjlydw', $keys)) {
            $expression['sjlydw'] = $fulfillmentInfo->getSjlydw();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $fulfillmentInfo->getStatus();
        }
        
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $fulfillmentInfo->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['performance'])) {
            $expression['performance'] = $this->getPerformanceTranslator()->objectToArray(
                $fulfillmentInfo->getPerformance(),
                $keys['performance']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $fulfillmentInfo->getOrganization(),
                $keys['organization']
            );
        }
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $fulfillmentInfo->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $fulfillmentInfo->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $fulfillmentInfo->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $fulfillmentInfo->getUpdateTime());
        }

        return $expression;
    }
}
