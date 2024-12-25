<?php
namespace Sdk\Member\Commitment\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Member\Commitment\Model\Commitment;
use Sdk\Member\Commitment\Adapter\Commitment\ICommitmentAdapter;
use Sdk\Member\Commitment\Adapter\Commitment\CommitmentMockAdapter;
use Sdk\Member\Commitment\Adapter\Commitment\CommitmentRestfulAdapter;

class CommitmentRepository extends CommonRepository implements ICommitmentAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'COMMITMENT_LIST';
    const FETCH_ONE_MODEL_UN = 'COMMITMENT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new CommitmentRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new CommitmentMockAdapter()
        );
    }

    //撤销
    public function revoke(Commitment $commitment) : bool
    {
        return $this->getAdapter()->revoke($commitment);
    }
}
