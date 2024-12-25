<?php
namespace Sdk\Interaction\Complaint\Adapter\Complaint;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Interaction\Complaint\Model\Complaint;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

//use Sdk\Interaction\Complaint\Utils\MockObjectGenerate;

class ComplaintMockAdapter implements IComplaintAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Complaint($id);
       // return MockObjectGenerate::generateComplaint($id);
    }

    public function accept(CommonInteraction $complaint) : bool
    {
        unset($complaint);
        return true;
    }

    public function forward(CommonInteraction $complaint) : bool
    {
        unset($complaint);
        return true;
    }

    public function revoke(CommonInteraction $complaint) : bool
    {
        unset($complaint);
        return true;
    }
}
