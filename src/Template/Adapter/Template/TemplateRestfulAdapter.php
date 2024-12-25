<?php
namespace Sdk\Template\Adapter\Template;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Template\Model\Template;
use Sdk\Template\Model\NullTemplate;
use Sdk\Template\Translator\TemplateRestfulTranslator;

class TemplateRestfulAdapter extends CommonRestfulAdapter implements ITemplateAdapter
{
    use FetchAbleRestfulAdapterTrait, MapErrorsTrait;

    const MAP_ERROR = array();

    const SCENARIOS = [
        'TEMPLATE_LIST'=>['fields' => []],
        'TEMPLATE_FETCH_ONE'=>['fields'=>[]]
    ];

    const EXPORT_CATEGORY_ROUTE_MAPPING = array(
        Template::CATEGORY['COMMITMENT'] => 'application/commitments',
        Template::CATEGORY['CONTRACT_PERFORMANCE'] => 'contract/performances'
    );

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new TemplateRestfulTranslator(),
            'application',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullTemplate::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function export(Template $template) : bool
    {
        $route = isset(self::EXPORT_CATEGORY_ROUTE_MAPPING[$template->getCategory()]) ?
                    self::EXPORT_CATEGORY_ROUTE_MAPPING[$template->getCategory()] :
                    '';
                    
        $this->post(
            $route.'/template/export'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($template);
            return true;
        }

        return false;
    }
}
