<?php
namespace Sdk\Evaluation\ScoreModel\Translator;

use IntlChar;
use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Evaluation\ScoreModel\Model\ScoreModel;
use Sdk\Evaluation\ScoreModel\Model\NullScoreModel;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ScoreModelTranslator implements ITranslator
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

    protected function getNullObject() : INull
    {
        return NullScoreModel::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($scoreModel, array $keys = array())
    {
        if (!$scoreModel instanceof ScoreModel) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'description',
                'maxScore',
                'baseScore',
                'ranks',
                'indicatorWeights',
                'object',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($scoreModel->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $scoreModel->getName();
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $scoreModel->getDescription();
        }
        if (in_array('maxScore', $keys)) {
            $expression['maxScore'] = $scoreModel->getMaxScore();
        }
        if (in_array('baseScore', $keys)) {
            $expression['baseScore'] = $scoreModel->getBaseScore();
        }
        if (in_array('ranks', $keys)) {
            $expression['ranks'] = $scoreModel->getRanks();
        }
        if (in_array('indicatorWeights', $keys)) {
            $expression['indicatorWeights'] = $this->indicatorWeightsFormatConversion(
                $scoreModel->getIndicatorWeights()
            );
        }
        if (in_array('object', $keys)) {
            $expression['object'] = $this->objectFormatConversion(
                $scoreModel->getObject()
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $scoreModel->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($scoreModel, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $scoreModel->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $scoreModel->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $scoreModel->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $scoreModel->getUpdateTime());
        }

        return $expression;
    }

    protected function objectFormatConversion($object)
    {
        $objectFormatConversion = array();
        foreach ($object as $id) {
            $objectFormatConversion[] = $this->typeFormatConversion($id, ScoreModel::OBJECT_CN);
        }

        return $objectFormatConversion;
    }

    protected function indicatorWeightsFormatConversion($indicatorWeights)
    {
        foreach ($indicatorWeights as $key => $indicatorWeight) {
            if (isset($indicatorWeight['indicator']['id'])) {
                $indicatorWeights[$key]['indicator']['id'] = marmot_encode($indicatorWeight['indicator']['id']);
            }
            if (isset($indicatorWeight['indicator']['category'])) {
                $indicatorWeights[$key]['indicator']['category'] = marmot_encode(
                    $indicatorWeight['indicator']['category']
                );
            }
            if (isset($indicatorWeight['indicator']['source']['id'])) {
                $indicatorWeights[$key]['indicator']['source']['id'] = marmot_encode(
                    $indicatorWeight['indicator']['source']['id']
                );
            }
            if (isset($indicatorWeight['indicator']['source']['infoCategory'])) {
                $indicatorWeights[$key]['indicator']['source']['infoCategory'] = marmot_encode(
                    $indicatorWeight['indicator']['source']['infoCategory']
                );
            }
            if (isset($indicatorWeight['indicator']['source']['subjectCategory'])) {
                $indicatorWeights[$key]['indicator']['source']['subjectCategory'] = marmot_encode(
                    $indicatorWeight['indicator']['source']['subjectCategory']
                );
            }
        }

        return $indicatorWeights;
    }

    protected function relationObjectToArray(ScoreModel $scoreModel, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $scoreModel->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $scoreModel->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
