<?php
namespace Sdk\Contract\FulfillmentInfo\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Contract\FulfillmentInfo\Model\FulfillmentInfo;
use Sdk\Contract\FulfillmentInfo\Model\NullFulfillmentInfo;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Contract\Performance\Translator\PerformanceRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class FulfillmentInfoRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $fulfillmentInfo = null)
    {
        if (empty($expression)) {
            return NullFulfillmentInfo::getInstance();
        }

        if ($fulfillmentInfo == null) {
            $fulfillmentInfo = new FulfillmentInfo();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $fulfillmentInfo->setId($data['id']);
        }
        if (isset($attributes['htzxjd'])) {
            $fulfillmentInfo->setHtzxjd($attributes['htzxjd']);
        }
        if (isset($attributes['htzjsfqezf'])) {
            $fulfillmentInfo->setHtzjsfqezf($attributes['htzjsfqezf']);
        }
        if (isset($attributes['sjlydw'])) {
            $fulfillmentInfo->setSjlydw($attributes['sjlydw']);
        }
        if (isset($attributes['status'])) {
            $fulfillmentInfo->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $fulfillmentInfo->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $fulfillmentInfo->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $fulfillmentInfo->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['contractPerformance'])) {
            $performanceArray = $this->relationshipFill($relationships['contractPerformance'], $included);
            $performance = $this->getPerformanceRestfulTranslator()->arrayToObject($performanceArray);
            $fulfillmentInfo->setPerformance($performance);
        }
        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $fulfillmentInfo->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $fulfillmentInfo->setStaff($staff);
        }
        
        return $fulfillmentInfo;
    }

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
                'performance',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'fulfillmentInfos'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $fulfillmentInfo->getId();
        }

        $attributes = array();

        if (in_array('htzxjd', $keys)) {
            $attributes['htzxjd'] = $fulfillmentInfo->getHtzxjd();
        }
        if (in_array('htzjsfqezf', $keys)) {
            $attributes['htzjsfqezf'] = $fulfillmentInfo->getHtzjsfqezf();
        }
        if (in_array('sjlydw', $keys)) {
            $attributes['sjlydw'] = $fulfillmentInfo->getSjlydw();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('performance', $keys)) {
            $expression['data']['relationships']['contractPerformance']['data'] = array(
                'type' => 'contractPerformances',
                'id' => strval($fulfillmentInfo->getPerformance()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($fulfillmentInfo->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}
