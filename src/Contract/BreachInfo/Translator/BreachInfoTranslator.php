<?php
namespace Sdk\Contract\BreachInfo\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Contract\BreachInfo\Model\BreachInfo;
use Sdk\Contract\BreachInfo\Model\NullBreachInfo;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Contract\Performance\Translator\PerformanceTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class BreachInfoTranslator implements ITranslator
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
        return NullBreachInfo::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($breachInfo, array $keys = array())
    {
        if (!$breachInfo instanceof BreachInfo) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'wyf',
                'wysy',
                'wyyj',
                'wyzt',
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
            $expression['id'] = marmot_encode($breachInfo->getId());
        }
        if (in_array('wyf', $keys)) {
            $expression['wyf'] = $breachInfo->getWyf();
        }
        if (in_array('wysy', $keys)) {
            $expression['wysy'] = $breachInfo->getWysy();
        }
        if (in_array('wyyj', $keys)) {
            $expression['wyyj'] = $breachInfo->getWyyj();
        }
        if (in_array('wyzt', $keys)) {
            $expression['wyzt'] = $breachInfo->getWyzt();
        }
        if (in_array('sjlydw', $keys)) {
            $expression['sjlydw'] = $breachInfo->getSjlydw();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $breachInfo->getStatus();
        }
        
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $breachInfo->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['performance'])) {
            $expression['performance'] = $this->getPerformanceTranslator()->objectToArray(
                $breachInfo->getPerformance(),
                $keys['performance']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $breachInfo->getOrganization(),
                $keys['organization']
            );
        }
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $breachInfo->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $breachInfo->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $breachInfo->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $breachInfo->getUpdateTime());
        }

        return $expression;
    }
}
