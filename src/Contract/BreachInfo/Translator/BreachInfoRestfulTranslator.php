<?php
namespace Sdk\Contract\BreachInfo\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Contract\BreachInfo\Model\BreachInfo;
use Sdk\Contract\BreachInfo\Model\NullBreachInfo;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Contract\Performance\Translator\PerformanceRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class BreachInfoRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getPerformanceRestfulTranslator() : PerformanceRestfulTranslator
    {
        return new PerformanceRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $breachInfo = null)
    {
        if (empty($expression)) {
            return NullBreachInfo::getInstance();
        }

        if ($breachInfo == null) {
            $breachInfo = new BreachInfo();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $breachInfo->setId($data['id']);
        }
        if (isset($attributes['wyf'])) {
            $breachInfo->setWyf($attributes['wyf']);
        }
        if (isset($attributes['wysy'])) {
            $breachInfo->setWysy($attributes['wysy']);
        }
        if (isset($attributes['wyyj'])) {
            $breachInfo->setWyyj($attributes['wyyj']);
        }
        if (isset($attributes['wyzt'])) {
            $breachInfo->setWyzt($attributes['wyzt']);
        }
        if (isset($attributes['sjlydw'])) {
            $breachInfo->setSjlydw($attributes['sjlydw']);
        }
        if (isset($attributes['status'])) {
            $breachInfo->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $breachInfo->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $breachInfo->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $breachInfo->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['contractPerformance'])) {
            $performanceArray = $this->relationshipFill($relationships['contractPerformance'], $included);
            $performance = $this->getPerformanceRestfulTranslator()->arrayToObject($performanceArray);
            $breachInfo->setPerformance($performance);
        }
        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $breachInfo->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $breachInfo->setStaff($staff);
        }
        
        return $breachInfo;
    }

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
                'performance',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'breachInfos'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $breachInfo->getId();
        }

        $attributes = array();

        if (in_array('wyf', $keys)) {
            $attributes['wyf'] = $breachInfo->getWyf();
        }
        if (in_array('wysy', $keys)) {
            $attributes['wysy'] = $breachInfo->getWysy();
        }
        if (in_array('wyyj', $keys)) {
            $attributes['wyyj'] = $breachInfo->getWyyj();
        }
        if (in_array('wyzt', $keys)) {
            $attributes['wyzt'] = $breachInfo->getWyzt();
        }
        if (in_array('sjlydw', $keys)) {
            $attributes['sjlydw'] = $breachInfo->getSjlydw();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('performance', $keys)) {
            $expression['data']['relationships']['contractPerformance']['data'] = array(
                'type' => 'contractPerformances',
                'id' => strval($breachInfo->getPerformance()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($breachInfo->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}
