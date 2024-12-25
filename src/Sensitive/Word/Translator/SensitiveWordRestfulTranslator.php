<?php
namespace Sdk\Sensitive\Word\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Sensitive\Word\Model\SensitiveWord;
use Sdk\Sensitive\Word\Model\NullSensitiveWord;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class SensitiveWordRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $sensitiveWord = null)
    {
        if (empty($expression)) {
            return NullSensitiveWord::getInstance();
        }

        if ($sensitiveWord == null) {
            $sensitiveWord = new SensitiveWord();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $sensitiveWord->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $sensitiveWord->setName($attributes['name']);
        }
        if (isset($attributes['source'])) {
            $sensitiveWord->setSource($attributes['source']);
        }
        if (isset($attributes['remark'])) {
            $sensitiveWord->setRemark($attributes['remark']);
        }
        if (isset($attributes['status'])) {
            $sensitiveWord->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $sensitiveWord->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $sensitiveWord->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $sensitiveWord->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $sensitiveWord->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $sensitiveWord->setStaff($staff);
        }

        if (isset($relationships['implementationUnits'])) {
            $implementationUnits = $this->relationshipsFill($relationships['implementationUnits'], $included);

            foreach ($implementationUnits as $implementationUnitArray) {
                $implementationUnit = $this->getOrganizationRestfulTranslator()->arrayToObject(
                    $implementationUnitArray
                );
                $sensitiveWord->addImplementationUnit($implementationUnit);
            }
        }
        
        return $sensitiveWord;
    }

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
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'sensitiveWords'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $sensitiveWord->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $sensitiveWord->getName();
        }
        if (in_array('source', $keys)) {
            $attributes['source'] = $sensitiveWord->getSource();
        }
        if (in_array('remark', $keys)) {
            $attributes['remark'] = $sensitiveWord->getRemark();
        }
        
        if (!empty($attributes)) {
            $expression['data']['attributes'] = $attributes;
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($sensitiveWord->getStaff()->getId())
            );
        }

        return $expression;
    }
}
