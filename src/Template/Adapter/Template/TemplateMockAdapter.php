<?php
namespace Sdk\Template\Adapter\Template;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Template\Model\Template;
use Sdk\Template\Utils\MockObjectGenerate;

class TemplateMockAdapter implements ITemplateAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Template($id);
        //return MockObjectGenerate::generateTemplate($id);
    }

    public function export(Template $template) : bool
    {
        unset($template);
        return true;
    }
}
