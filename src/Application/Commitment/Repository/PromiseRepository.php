<?php
namespace Sdk\Application\Commitment\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Application\Commitment\Adapter\Promise\IPromiseAdapter;
use Sdk\Application\Commitment\Adapter\Promise\PromiseMockAdapter;
use Sdk\Application\Commitment\Adapter\Promise\PromiseRestfulAdapter;

class PromiseRepository extends CommonRepository implements IPromiseAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'PROMISE_LIST';
    const FETCH_ONE_MODEL_UN = 'PROMISE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new PromiseRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new PromiseMockAdapter()
        );
    }
}
