<?php
namespace Sdk\Monitor\FocusMonitor\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitor;
use Sdk\Monitor\FocusMonitor\Model\NullFocusMonitor;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class FocusMonitorRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $focusMonitor = null)
    {
        if (empty($expression)) {
            return NullFocusMonitor::getInstance();
        }

        if ($focusMonitor == null) {
            $focusMonitor = new FocusMonitor();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $focusMonitor->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $focusMonitor->setName($attributes['name']);
        }
        if (isset($attributes['identify'])) {
            $focusMonitor->setIdentify($attributes['identify']);
        }
        if (isset($attributes['subjectCategory'])) {
            $focusMonitor->setSubjectCategory($attributes['subjectCategory']);
        }
        if (isset($attributes['penaltyThreshold'])) {
            $focusMonitor->setPenaltyThreshold($attributes['penaltyThreshold']);
        }
        if (isset($attributes['dishonestyThreshold'])) {
            $focusMonitor->setDishonestyThreshold($attributes['dishonestyThreshold']);
        }
        if (isset($attributes['status'])) {
            $focusMonitor->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $focusMonitor->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $focusMonitor->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $focusMonitor->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $focusMonitor->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $focusMonitor->setStaff($staff);
        }
        
        return $focusMonitor;
    }

    public function objectToArray($focusMonitor, array $keys = array())
    {
        if (!$focusMonitor instanceof FocusMonitor) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'identify',
                'subjectCategory',
                'penaltyThreshold',
                'dishonestyThreshold',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'focusMonitors'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $focusMonitor->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $focusMonitor->getName();
        }
        if (in_array('identify', $keys)) {
            $attributes['identify'] = $focusMonitor->getIdentify();
        }
        if (in_array('subjectCategory', $keys)) {
            $attributes['subjectCategory'] = $focusMonitor->getSubjectCategory();
        }
        if (in_array('penaltyThreshold', $keys)) {
            $attributes['penaltyThreshold'] = $focusMonitor->getPenaltyThreshold();
        }
        if (in_array('dishonestyThreshold', $keys)) {
            $attributes['dishonestyThreshold'] = $focusMonitor->getDishonestyThreshold();
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($focusMonitor->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}
