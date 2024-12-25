<?php
namespace Sdk\CreditReport\CommonConfig\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;
use Sdk\CreditReport\CommonConfig\Model\NullCommonConfig;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

use Marmot\Framework\Classes\Filter;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class CommonConfigRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    public function arrayToObject(array $expression, $commonConfig = null)
    {
        if (empty($expression)) {
            return NullCommonConfig::getInstance();
        }

        if ($commonConfig == null) {
            $commonConfig = new CommonConfig();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $commonConfig->setId($data['id']);
        }
        if (isset($attributes['content'])) {
            $commonConfig->setDiyContent(Filter::dhtmlspecialchars($attributes['content']));
        }
        if (isset($attributes['status'])) {
            $commonConfig->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $commonConfig->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $commonConfig->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $commonConfig->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $commonConfig->setStaff($staff);
        }

        return $commonConfig;
    }

    public function objectToArray($commonConfig, array $keys = array())
    {
        if (!$commonConfig instanceof CommonConfig) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'diyContent',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'commonConfigs'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $commonConfig->getId();
        }

        $attributes = array();

        if (in_array('diyContent', $keys)) {
            $attributes['content'] = $commonConfig->getDiyContent();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($commonConfig->getStaff()->getId())
            );
        }

        return $expression;
    }
}
