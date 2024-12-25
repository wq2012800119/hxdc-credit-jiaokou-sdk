<?php
namespace Sdk\Evaluation\ScoreModel\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Evaluation\ScoreModel\Model\ScoreModel;
use Sdk\Evaluation\ScoreModel\Model\NullScoreModel;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class ScoreModelRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $scoreModel = null)
    {
        if (empty($expression)) {
            return NullScoreModel::getInstance();
        }

        if ($scoreModel == null) {
            $scoreModel = new ScoreModel();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $scoreModel->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $scoreModel->setName($attributes['name']);
        }
        if (isset($attributes['description'])) {
            $scoreModel->setDescription($attributes['description']);
        }
        if (isset($attributes['maxScore'])) {
            $scoreModel->setMaxScore($attributes['maxScore']);
        }
        if (isset($attributes['baseScore'])) {
            $scoreModel->setBaseScore($attributes['baseScore']);
        }
        if (isset($attributes['ranks'])) {
            $scoreModel->setRanks($attributes['ranks']);
        }
        if (isset($attributes['indicatorWeights'])) {
            $scoreModel->setIndicatorWeights($attributes['indicatorWeights']);
        }
        if (isset($attributes['object'])) {
            $object = $this->objectSplit($attributes['object']);
            $scoreModel->setObject($object);
        }
        if (isset($attributes['status'])) {
            $scoreModel->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $scoreModel->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $scoreModel->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $scoreModel->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $scoreModel->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $scoreModel->setStaff($staff);
        }
        
        return $scoreModel;
    }

    protected function objectSplit(int $object) : array
    {
        $objectArray = array();

        foreach (ScoreModel::OBJECT as $value) {
            if (($value & $object) == $value) {
                $objectArray[] = $value;
            }
        }

        return $objectArray;
    }

    protected function objectMerge(array $objectArray) : int
    {
        $object = 0;

        foreach ($objectArray as $value) {
            $object += $value;
        }

        return $object;
    }

    public function objectToArray($scoreModel, array $keys = array())
    {
        if (!$scoreModel instanceof ScoreModel) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'object',
                'description',
                'maxScore',
                'baseScore',
                'ranks',
                'indicatorWeights',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'scoreModels'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $scoreModel->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $scoreModel->getName();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $scoreModel->getDescription();
        }
        if (in_array('maxScore', $keys)) {
            $attributes['maxScore'] = $scoreModel->getMaxScore();
        }
        if (in_array('baseScore', $keys)) {
            $attributes['baseScore'] = $scoreModel->getBaseScore();
        }
        if (in_array('ranks', $keys)) {
            $attributes['ranks'] = $scoreModel->getRanks();
        }
        if (in_array('indicatorWeights', $keys)) {
            $attributes['indicatorWeights'] = $scoreModel->getIndicatorWeights();
        }
        if (in_array('object', $keys)) {
            $object = $this->objectMerge($scoreModel->getObject());
            $attributes['object'] = $object;
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($scoreModel->getStaff()->getId())
            );
        }

        return $expression;
    }
}
