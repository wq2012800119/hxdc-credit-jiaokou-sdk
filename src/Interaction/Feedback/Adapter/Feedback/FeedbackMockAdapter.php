<?php
namespace Sdk\Interaction\Feedback\Adapter\Feedback;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Interaction\Feedback\Model\Feedback;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

//use Sdk\Interaction\Feedback\Utils\MockObjectGenerate;

class FeedbackMockAdapter implements IFeedbackAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Feedback($id);
       // return MockObjectGenerate::generateFeedback($id);
    }

    public function accept(CommonInteraction $feedback) : bool
    {
        unset($feedback);
        return true;
    }

    public function forward(CommonInteraction $feedback) : bool
    {
        unset($feedback);
        return true;
    }

    public function revoke(CommonInteraction $feedback) : bool
    {
        unset($feedback);
        return true;
    }
}
