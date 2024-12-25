<?php
namespace Sdk\Template\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Template\Model\Template;
use Sdk\Template\Model\NullTemplate;

class TemplateTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullTemplate::getInstance();
    }

    public function objectToArray($template, array $keys = array())
    {
        if (!$template instanceof Template) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'path'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($template->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $template->getName();
        }
        if (in_array('path', $keys)) {
            $expression['path'] = $template->getPath();
        }

        return $expression;
    }
}
