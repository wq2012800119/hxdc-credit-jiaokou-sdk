<?php
namespace Sdk\Interaction\Interlocution\Adapter\Interlocution;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Interaction\Interlocution\Model\Interlocution;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

//use Sdk\Interaction\Interlocution\Utils\MockObjectGenerate;

class InterlocutionMockAdapter implements IInterlocutionAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Interlocution($id);
       // return MockObjectGenerate::generateInterlocution($id);
    }

    public function accept(CommonInteraction $interlocution) : bool
    {
        unset($interlocution);
        return true;
    }

    public function forward(CommonInteraction $interlocution) : bool
    {
        unset($interlocution);
        return true;
    }

    public function revoke(CommonInteraction $interlocution) : bool
    {
        unset($interlocution);
        return true;
    }
}
