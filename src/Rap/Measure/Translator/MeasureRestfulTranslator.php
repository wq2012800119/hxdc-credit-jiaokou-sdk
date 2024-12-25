<?php
namespace Sdk\Rap\Measure\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Rap\Measure\Model\Measure;
use Sdk\Rap\Measure\Model\NullMeasure;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Rap\Memorandum\Translator\MemorandumRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class MeasureRestfulTranslator implements IRestfulTranslator
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

    protected function getMemorandumRestfulTranslator() : MemorandumRestfulTranslator
    {
        return new MemorandumRestfulTranslator();
    }

    public function arrayToObject(array $expression, $measure = null)
    {
        if (empty($expression)) {
            return NullMeasure::getInstance();
        }

        if ($measure == null) {
            $measure = new Measure();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $measure->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $measure->setName($attributes['name']);
        }
        if (isset($attributes['description'])) {
            $measure->setDescription($attributes['description']);
        }
        if (isset($attributes['rewardType'])) {
            $measure->setRewardType($attributes['rewardType']);
        }
        if (isset($attributes['status'])) {
            $measure->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $measure->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $measure->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $measure->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $measure->setOrganization($organization);
        }

        if (isset($relationships['memorandum'])) {
            $memorandumArray = $this->relationshipFill($relationships['memorandum'], $included);
            $memorandum = $this->getMemorandumRestfulTranslator()->arrayToObject($memorandumArray);
            $measure->setMemorandum($memorandum);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $measure->setStaff($staff);
        }

        if (isset($relationships['implementationUnits'])) {
            $implementationUnits = $this->relationshipsFill($relationships['implementationUnits'], $included);

            foreach ($implementationUnits as $implementationUnitArray) {
                $implementationUnit = $this->getOrganizationRestfulTranslator()->arrayToObject(
                    $implementationUnitArray
                );
                $measure->addImplementationUnit($implementationUnit);
            }
        }
        
        return $measure;
    }

    public function objectToArray($measure, array $keys = array())
    {
        if (!$measure instanceof Measure) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'description',
                'implementationUnits',
                'memorandum',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'measures'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $measure->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $measure->getName();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $measure->getDescription();
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($measure->getStaff()->getId())
            );
        }
        
        if (in_array('memorandum', $keys)) {
            $expression['data']['relationships']['memorandum']['data'] = array(
                'type' => 'memorandums',
                'id' => strval($measure->getMemorandum()->getId())
            );
        }
        
        if (in_array('implementationUnits', $keys)) {
            $unitsRelationships = array();

            foreach ($measure->getImplementationUnits() as $implementationUnit) {
                $unitsRelationships[] = array(
                    'type' => 'organizations',
                    'id' => strval($implementationUnit->getId())
                );
            }

            if (!empty($unitsRelationships)) {
                $expression['data']['relationships']['implementationUnits']['data'] = $unitsRelationships;
            }
        }

        return $expression;
    }
}
