<?php
namespace Sdk\Evaluation\Scenario\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Evaluation\Scenario\Model\Scenario;
use Sdk\Evaluation\Scenario\Model\NullScenario;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Evaluation\ScoreModel\Translator\ScoreModelTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ScenarioTranslator implements ITranslator
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

    protected function getScoreModelTranslator() : ScoreModelTranslator
    {
        return new ScoreModelTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullScenario::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'organization' => ['id', 'name'],
                'scoreModel' => [],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($scenario->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $scenario->getName();
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $scenario->getDescription();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $scenario->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($scenario, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $scenario->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $scenario->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $scenario->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $scenario->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Scenario $scenario, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $scenario->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['scoreModel'])) {
            $expression['scoreModel'] = $this->getScoreModelTranslator()->objectToArray(
                $scenario->getScoreModel(),
                $keys['scoreModel']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $scenario->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
