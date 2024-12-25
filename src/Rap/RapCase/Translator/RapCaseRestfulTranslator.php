<?php
namespace Sdk\Rap\RapCase\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Rap\RapCase\Model\RapCase;
use Sdk\Rap\RapCase\Model\NullRapCase;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;
use Sdk\Rap\Measure\Translator\MeasureRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class RapCaseRestfulTranslator implements IRestfulTranslator
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

    protected function getDataRestfulTranslator() : DataRestfulTranslator
    {
        return new DataRestfulTranslator();
    }

    protected function getMeasureRestfulTranslator() : MeasureRestfulTranslator
    {
        return new MeasureRestfulTranslator();
    }

    public function arrayToObject(array $expression, $rapCase = null)
    {
        if (empty($expression)) {
            return NullRapCase::getInstance();
        }

        if ($rapCase == null) {
            $rapCase = new RapCase();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $rapCase->setId($data['id']);
        }
        if (isset($attributes['HHMDMC'])) {
            $rapCase->setHhmdmc($attributes['HHMDMC']);
        }
        if (isset($attributes['ZTMC'])) {
            $rapCase->setZtmc($attributes['ZTMC']);
        }
        if (isset($attributes['ZTLB'])) {
            $rapCase->setZtlb($attributes['ZTLB']);
        }
        if (isset($attributes['identify'])) {
            $rapCase->setIdentify($attributes['identify']);
        }
        if (isset($attributes['ZJLX'])) {
            $rapCase->setZjlx($attributes['ZJLX']);
        }
        if (isset($attributes['JCLX'])) {
            $rapCase->setJclx($attributes['JCLX']);
        }
        if (isset($attributes['ZXCSNR'])) {
            $rapCase->setZxcsnr($attributes['ZXCSNR']);
        }
        if (isset($attributes['SJJE'])) {
            $rapCase->setSjje($attributes['SJJE']);
        }
        if (isset($attributes['JCSM'])) {
            $rapCase->setJcsm($attributes['JCSM']);
        }
        if (isset($attributes['status'])) {
            $rapCase->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $rapCase->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $rapCase->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $rapCase->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $rapCase->setOrganization($organization);
        }
        if (isset($relationships['feedbackOrganization'])) {
            $fkbmArray = $this->relationshipFill($relationships['feedbackOrganization'], $included);
            $fkbm = $this->getOrganizationRestfulTranslator()->arrayToObject($fkbmArray);
            $rapCase->setFkbm($fkbm);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $rapCase->setStaff($staff);
        }
        if (isset($relationships['data'])) {
            $resourceDataArray = $this->relationshipFill($relationships['data'], $included);
            $resourceData = $this->getDataRestfulTranslator()->arrayToObject($resourceDataArray);
            $rapCase->setData($resourceData);
        }
        if (isset($relationships['measure'])) {
            $measureArray = $this->relationshipFill($relationships['measure'], $included);
            $measure = $this->getMeasureRestfulTranslator()->arrayToObject($measureArray);
            $rapCase->setMeasure($measure);
        }
        
        return $rapCase;
    }

    public function objectToArray($rapCase, array $keys = array())
    {
        if (!$rapCase instanceof RapCase) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'zjlx',
                'jcsm',
                'sjje',
                'data',
                'fkbm',
                'measure',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'cases'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $rapCase->getId();
        }

        $attributes = array();

        if (in_array('zjlx', $keys)) {
            $attributes['ZJLX'] = $rapCase->getZjlx();
        }
        if (in_array('jcsm', $keys)) {
            $attributes['JCSM'] = $rapCase->getJcsm();
        }
        if (in_array('sjje', $keys)) {
            $attributes['SJJE'] = $rapCase->getSjje();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($rapCase->getStaff()->getId())
            );
        }

        if (in_array('data', $keys)) {
            $expression['data']['relationships']['data']['data'] = array(
                'type' => 'data',
                'id' => strval($rapCase->getData()->getId())
            );
        }

        if (in_array('fkbm', $keys)) {
            $expression['data']['relationships']['feedbackOrganization']['data'] = array(
                'type' => 'organizations',
                'id' => strval($rapCase->getFkbm()->getId())
            );
        }
        
        if (in_array('measure', $keys)) {
            $expression['data']['relationships']['measure']['data'] = array(
                'type' => 'measures',
                'id' => strval($rapCase->getMeasure()->getId())
            );
        }

        return $expression;
    }
}
