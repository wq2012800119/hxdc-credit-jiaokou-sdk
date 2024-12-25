<?php
namespace Sdk\Interaction\Feedback\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;
use Sdk\Interaction\Feedback\Adapter\Feedback\IFeedbackAdapter;
use Sdk\Interaction\Feedback\Adapter\Feedback\FeedbackMockAdapter;
use Sdk\Interaction\Feedback\Adapter\Feedback\FeedbackRestfulAdapter;

class FeedbackRepository extends CommonRepository implements IFeedbackAdapter
{
    const LIST_MODEL_UN = 'FEEDBACK_LIST';
    const FETCH_ONE_MODEL_UN = 'FEEDBACK_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new FeedbackRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new FeedbackMockAdapter()
        );
    }

    //受理
    public function accept(CommonInteraction $feedback) : bool
    {
        return $this->getAdapter()->accept($feedback);
    }

    //转交
    public function forward(CommonInteraction $feedback) : bool
    {
        return $this->getAdapter()->forward($feedback);
    }

    //撤销
    public function revoke(CommonInteraction $feedback) : bool
    {
        return $this->getAdapter()->revoke($feedback);
    }
}
