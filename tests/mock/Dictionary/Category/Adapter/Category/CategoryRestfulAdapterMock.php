<?php
namespace Sdk\Dictionary\Category\Adapter\Category;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;

class CategoryRestfulAdapterMock extends CategoryRestfulAdapter
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getScenario() : array
    {
        return parent::getScenario();
    }
}
