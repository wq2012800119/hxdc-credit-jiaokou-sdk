<?php
namespace Sdk\Evaluation\Scenario\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Evaluation\Scenario\Model\Scenario;
use Sdk\Evaluation\Scenario\Model\NullScenario;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Evaluation\ScoreModel\Translator\ScoreModelRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class ScenarioRestfulTranslator implements IRestfulTranslator
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

    protected function getScoreModelRestfulTranslator() : ScoreModelRestfulTranslator
    {
        return new ScoreModelRestfulTranslator();
    }

    public function arrayToObject(array $expression, $scenario = null)
    {
        if (empty($expression)) {
            return NullScenario::getInstance();
        }

        if ($scenario == null) {
            $scenario = new Scenario();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $scenario->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $scenario->setName($attributes['name']);
        }
        if (isset($attributes['description'])) {
            $scenario->setDescription($attributes['description']);
        }
        if (isset($attributes['status'])) {
            $scenario->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $scenario->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $scenario->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $scenario->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $scenario->setOrganization($organization);
        }

        if (isset($relationships['scoreModel'])) {
            $scoreModelArray = $this->relationshipFill($relationships['scoreModel'], $included);
            $scoreModel = $this->getScoreModelRestfulTranslator()->arrayToObject($scoreModelArray);
            $scenario->setScoreModel($scoreModel);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $scenario->setStaff($staff);
        }
        
        return $scenario;
    }

    public function objectToArray($scenario, array $keys = array())
    {
        if (!$scenario instanceof Scenario) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'description',
                'scoreModel',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'scenarios'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $scenario->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $scenario->getName();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $scenario->getDescription();
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($scenario->getStaff()->getId())
            );
        }
        
        if (in_array('scoreModel', $keys)) {
            $expression['data']['relationships']['scoreModel']['data'] = array(
                'type' => 'scoreModels',
                'id' => strval($scenario->getScoreModel()->getId())
            );
        }

        return $expression;
    }
}
