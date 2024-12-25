<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;
use Sdk\WebsiteConfig\HelpPageConfig\Model\NullHelpPageConfig;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class HelpPageConfigRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    public function arrayToObject(array $expression, $helpPageConfig = null)
    {
        if (empty($expression)) {
            return NullHelpPageConfig::getInstance();
        }

        if ($helpPageConfig == null) {
            $helpPageConfig = new HelpPageConfig();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $helpPageConfig->setId($data['id']);
        }
        if (isset($attributes['title'])) {
            $helpPageConfig->setTitle($attributes['title']);
        }
        if (isset($attributes['style'])) {
            $helpPageConfig->setStyle($attributes['style']);
        }
        if (isset($attributes['content'])) {
            $helpPageConfig->setDiyContent($attributes['content']);
        }
        if (isset($attributes['status'])) {
            $helpPageConfig->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $helpPageConfig->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $helpPageConfig->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $helpPageConfig->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $helpPageConfig->setStaff($staff);
        }

        return $helpPageConfig;
    }

    public function objectToArray($helpPageConfig, array $keys = array())
    {
        if (!$helpPageConfig instanceof HelpPageConfig) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'title',
                'style',
                'diyContent',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'helpPages'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $helpPageConfig->getId();
        }

        $attributes = array();

        if (in_array('title', $keys)) {
            $attributes['title'] = $helpPageConfig->getTitle();
        }
        if (in_array('style', $keys)) {
            $attributes['style'] = $helpPageConfig->getStyle();
        }
        if (in_array('diyContent', $keys)) {
            $attributes['content'] = $helpPageConfig->getDiyContent();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($helpPageConfig->getStaff()->getId())
            );
        }

        return $expression;
    }
}
