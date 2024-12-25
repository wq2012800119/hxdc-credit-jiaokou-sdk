<?php
namespace Sdk\Rap\RapCase\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Rap\RapCase\Model\RapCase;
use Sdk\Rap\RapCase\Model\NullRapCase;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

use Sdk\Resource\Data\Translator\DataTranslator;
use Sdk\Rap\Measure\Translator\MeasureTranslator;

class RapCaseTranslator implements ITranslator
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

    protected function getDataTranslator() : DataTranslator
    {
        return new DataTranslator();
    }

    protected function getMeasureTranslator() : MeasureTranslator
    {
        return new MeasureTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullRapCase::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($rapCase, array $keys = array())
    {
        if (!$rapCase instanceof RapCase) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'hhmdmc',
                'ztmc',
                'ztlb',
                'identify',
                'zjlx',
                'jclx',
                'zxcsnr',
                'sjje',
                'jcsm',
                'data' => ['id', 'subjectName'],
                'measure' => ['id', 'name'],
                'fkbm' => ['id', 'name'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($rapCase->getId());
        }
        if (in_array('hhmdmc', $keys)) {
            $expression['hhmdmc'] = $rapCase->getHhmdmc();
        }
        if (in_array('ztmc', $keys)) {
            $expression['ztmc'] = $rapCase->getZtmc();
        }
        if (in_array('ztlb', $keys)) {
            $expression['ztlb'] = $this->typeFormatConversion(
                $rapCase->getZtlb(),
                RapCase::ZTLB_CN
            );
        }
        if (in_array('identify', $keys)) {
            $expression['identify'] = $rapCase->getIdentify();
        }
        if (in_array('zjlx', $keys)) {
            $expression['zjlx'] = $this->typeFormatConversion(
                $rapCase->getZjlx(),
                RapCase::ZJLX_CN
            );
        }
        if (in_array('jclx', $keys)) {
            $expression['jclx'] = $this->typeFormatConversion(
                $rapCase->getJclx(),
                RapCase::JCLX_CN
            );
        }
        if (in_array('zxcsnr', $keys)) {
            $expression['zxcsnr'] = $rapCase->getZxcsnr();
        }
        if (in_array('sjje', $keys)) {
            $expression['sjje'] = $rapCase->getSjje();
        }
        if (in_array('jcsm', $keys)) {
            $expression['jcsm'] = $rapCase->getJcsm();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $rapCase->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $rapCase->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $rapCase->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $rapCase->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $rapCase->getUpdateTime());
        }

        $expression = $this->relationObjectToArray($rapCase, $keys, $expression);

        return $expression;
    }

    protected function relationObjectToArray(RapCase $rapCase, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $rapCase->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $rapCase->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['data'])) {
            $expression['data'] = $this->getDataTranslator()->objectToArray(
                $rapCase->getData(),
                $keys['data']
            );
        }
        if (isset($keys['measure'])) {
            $expression['measure'] = $this->getMeasureTranslator()->objectToArray(
                $rapCase->getMeasure(),
                $keys['measure']
            );
        }
        if (isset($keys['fkbm'])) {
            $expression['fkbm'] = $this->getOrganizationTranslator()->objectToArray(
                $rapCase->getFkbm(),
                $keys['fkbm']
            );
        }
        
        return $expression;
    }
}
