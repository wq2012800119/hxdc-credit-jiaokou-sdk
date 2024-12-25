<?php
namespace Sdk\Template\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Template\Model\Template;
use Sdk\Template\Adapter\Template\ITemplateAdapter;
use Sdk\Template\Adapter\Template\TemplateMockAdapter;
use Sdk\Template\Adapter\Template\TemplateRestfulAdapter;

class TemplateRepository extends CommonRepository implements ITemplateAdapter
{
    const LIST_MODEL_UN = 'TEMPLATE_LIST';
    const FETCH_ONE_MODEL_UN = 'TEMPLATE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new TemplateRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new TemplateMockAdapter()
        );
    }

    public function export(Template $template) : bool
    {
        return $this->getAdapter()->export($template);
    }
}
