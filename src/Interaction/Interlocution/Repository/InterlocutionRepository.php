<?php
namespace Sdk\Interaction\Interlocution\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;
use Sdk\Interaction\Interlocution\Adapter\Interlocution\IInterlocutionAdapter;
use Sdk\Interaction\Interlocution\Adapter\Interlocution\InterlocutionMockAdapter;
use Sdk\Interaction\Interlocution\Adapter\Interlocution\InterlocutionRestfulAdapter;

class InterlocutionRepository extends CommonRepository implements IInterlocutionAdapter
{
    const LIST_MODEL_UN = 'INTERLOCUTION_LIST';
    const FETCH_ONE_MODEL_UN = 'INTERLOCUTION_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new InterlocutionRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new InterlocutionMockAdapter()
        );
    }

    //受理
    public function accept(CommonInteraction $interlocution) : bool
    {
        return $this->getAdapter()->accept($interlocution);
    }

    //转交
    public function forward(CommonInteraction $interlocution) : bool
    {
        return $this->getAdapter()->forward($interlocution);
    }

    //撤销
    public function revoke(CommonInteraction $interlocution) : bool
    {
        return $this->getAdapter()->revoke($interlocution);
    }
}
