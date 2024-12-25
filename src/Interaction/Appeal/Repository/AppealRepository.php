<?php
namespace Sdk\Interaction\Appeal\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;
use Sdk\Interaction\Appeal\Adapter\Appeal\IAppealAdapter;
use Sdk\Interaction\Appeal\Adapter\Appeal\AppealMockAdapter;
use Sdk\Interaction\Appeal\Adapter\Appeal\AppealRestfulAdapter;

class AppealRepository extends CommonRepository implements IAppealAdapter
{
    const LIST_MODEL_UN = 'APPEAL_LIST';
    const FETCH_ONE_MODEL_UN = 'APPEAL_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new AppealRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new AppealMockAdapter()
        );
    }

    //受理
    public function accept(CommonInteraction $appeal) : bool
    {
        return $this->getAdapter()->accept($appeal);
    }

    //转交
    public function forward(CommonInteraction $appeal) : bool
    {
        return $this->getAdapter()->forward($appeal);
    }

    //撤销
    public function revoke(CommonInteraction $appeal) : bool
    {
        return $this->getAdapter()->revoke($appeal);
    }
}
