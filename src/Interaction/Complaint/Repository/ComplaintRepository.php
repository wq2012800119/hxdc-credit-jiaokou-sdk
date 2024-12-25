<?php
namespace Sdk\Interaction\Complaint\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;
use Sdk\Interaction\Complaint\Adapter\Complaint\IComplaintAdapter;
use Sdk\Interaction\Complaint\Adapter\Complaint\ComplaintMockAdapter;
use Sdk\Interaction\Complaint\Adapter\Complaint\ComplaintRestfulAdapter;

class ComplaintRepository extends CommonRepository implements IComplaintAdapter
{
    const LIST_MODEL_UN = 'COMPLAINT_LIST';
    const FETCH_ONE_MODEL_UN = 'COMPLAINT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ComplaintRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ComplaintMockAdapter()
        );
    }

    //受理
    public function accept(CommonInteraction $complaint) : bool
    {
        return $this->getAdapter()->accept($complaint);
    }

    //转交
    public function forward(CommonInteraction $complaint) : bool
    {
        return $this->getAdapter()->forward($complaint);
    }

    //撤销
    public function revoke(CommonInteraction $complaint) : bool
    {
        return $this->getAdapter()->revoke($complaint);
    }
}
