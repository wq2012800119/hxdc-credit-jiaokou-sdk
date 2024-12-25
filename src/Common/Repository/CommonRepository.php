<?php
namespace Sdk\Common\Repository;

use Marmot\Framework\Classes\Repository;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Repository\Traits\FetchRepositoryTrait;
use Sdk\Common\Repository\Traits\OperateAbleRepositoryTrait;

/**
 * @todo
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class CommonRepository extends Repository implements IFetchAbleAdapter, IOperateAbleAdapter
{
    use FetchRepositoryTrait,
        OperateAbleRepositoryTrait;

    private $adapter;

    private $mockAdapter;

    public function __construct($adapter, $mockAdapter)
    {
        $this->adapter = $adapter;
        $this->mockAdapter = $mockAdapter;
    }

    public function __destruct()
    {
        unset($this->adapter);
    }

    public function getActualAdapter()
    {
        return $this->adapter;
    }

    public function getMockAdapter()
    {
        return $this->mockAdapter;
    }

    public function scenario($scenario)
    {
        $this->getAdapter()->scenario($scenario);
        return $this;
    }
}
