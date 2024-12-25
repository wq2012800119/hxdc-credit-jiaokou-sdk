<?php
namespace Sdk\Interaction\Praise\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;
use Sdk\Interaction\Praise\Adapter\Praise\IPraiseAdapter;
use Sdk\Interaction\Praise\Adapter\Praise\PraiseMockAdapter;
use Sdk\Interaction\Praise\Adapter\Praise\PraiseRestfulAdapter;

class PraiseRepository extends CommonRepository implements IPraiseAdapter
{
    const LIST_MODEL_UN = 'PRAISE_LIST';
    const FETCH_ONE_MODEL_UN = 'PRAISE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new PraiseRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new PraiseMockAdapter()
        );
    }

    //受理
    public function accept(CommonInteraction $praise) : bool
    {
        return $this->getAdapter()->accept($praise);
    }

    //转交
    public function forward(CommonInteraction $praise) : bool
    {
        return $this->getAdapter()->forward($praise);
    }

    //撤销
    public function revoke(CommonInteraction $praise) : bool
    {
        return $this->getAdapter()->revoke($praise);
    }
}
