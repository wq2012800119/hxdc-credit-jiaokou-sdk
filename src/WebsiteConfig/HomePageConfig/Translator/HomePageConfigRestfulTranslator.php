<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class HomePageConfigRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    public function arrayToObject(array $expression, $homePageConfig = null)
    {
        if (empty($expression)) {
            return NullHomePageConfig::getInstance();
        }

        if ($homePageConfig == null) {
            $homePageConfig = new HomePageConfig();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $homePageConfig->setId($data['id']);
        }
        if (isset($attributes['versionDescription'])) {
            $homePageConfig->setVersionDescription($attributes['versionDescription']);
        }
        if (isset($attributes['content'])) {
            $homePageConfig->setDiyContent($attributes['content']);
        }
        if (isset($attributes['status'])) {
            $homePageConfig->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $homePageConfig->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $homePageConfig->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $homePageConfig->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $homePageConfig->setStaff($staff);
        }

        return $homePageConfig;
    }

    public function objectToArray($homePageConfig, array $keys = array())
    {
        if (!$homePageConfig instanceof HomePageConfig) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'versionDescription',
                'diyContent',
                'status',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'homePages'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $homePageConfig->getId();
        }

        $attributes = array();

        if (in_array('versionDescription', $keys)) {
            $attributes['versionDescription'] = $homePageConfig->getVersionDescription();
        }
        if (in_array('status', $keys)) {
            $attributes['status'] = $homePageConfig->getStatus();
        }
        if (in_array('diyContent', $keys)) {
            $attributes['content'] = $homePageConfig->getDiyContent();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($homePageConfig->getStaff()->getId())
            );
        }

        return $expression;
    }
}
