<?php
namespace Sdk\Template\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Template\Model\Template;
use Sdk\Template\Model\NullTemplate;

class TemplateRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $template = null)
    {
        if (empty($expression)) {
            return NullTemplate::getInstance();
        }

        if ($template == null) {
            $template = new Template();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        
        if (isset($data['id'])) {
            $template->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $template->setName($attributes['name']);
        }
        if (isset($attributes['path'])) {
            $template->setPath($attributes['path']);
        }

        return $template;
    }

    public function objectToArray($template, array $keys = array())
    {
        unset($template);
        unset($keys);

        return [];
    }
}
