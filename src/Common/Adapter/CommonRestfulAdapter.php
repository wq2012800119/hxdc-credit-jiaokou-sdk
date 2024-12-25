<?php
namespace Sdk\Common\Adapter;

use Marmot\Core;
use Marmot\Interfaces\IRestfulTranslator;
use Marmot\Basecode\Adapter\Restful\GuzzleAdapter;

 /**
 * @todo
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * 因需要向后端服务层传递登录用户的id,所以提出该父类
 */
class CommonRestfulAdapter extends GuzzleAdapter
{
    private $translator;
    
    private $resource;
    
    public function __construct(
        IRestfulTranslator $translator,
        string $resource = '',
        string $baseurl = '',
        array $headers = []
    ) {
        if (Core::$container->has('member')) {
            $headers['Member-Id'] = Core::$container->get('member')->getId();
        }

        if (Core::$container->has('staff')) {
            $headers['Staff-Id'] = Core::$container->get('staff')->getId();
        }
        parent::__construct(
            $baseurl,
            $headers
        );
        $this->translator = $translator;
        $this->resource = $resource;
        $this->scenario = array();
    }

    protected function getTranslator() : IRestfulTranslator
    {
        return $this->translator;
    }

    protected function getResource() : string
    {
        return $this->resource;
    }
}
