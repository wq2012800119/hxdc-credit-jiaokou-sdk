<?php
namespace Sdk\Interaction\Appeal\Adapter\Appeal;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Interaction\Appeal\Model\Appeal;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

//use Sdk\Interaction\Appeal\Utils\MockObjectGenerate;

class AppealMockAdapter implements IAppealAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Appeal($id);
       // return MockObjectGenerate::generateAppeal($id);
    }

    public function accept(CommonInteraction $appeal) : bool
    {
        unset($appeal);
        return true;
    }

    public function forward(CommonInteraction $appeal) : bool
    {
        unset($appeal);
        return true;
    }

    public function revoke(CommonInteraction $appeal) : bool
    {
        unset($appeal);
        return true;
    }
}
