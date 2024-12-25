<?php
namespace Sdk\Application\Commitment\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Application\Commitment\Model\Commitment;
use Sdk\Application\Commitment\Adapter\Commitment\ICommitmentAdapter;
use Sdk\Application\Commitment\Adapter\Commitment\CommitmentMockAdapter;
use Sdk\Application\Commitment\Adapter\Commitment\CommitmentRestfulAdapter;

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

    public function superviseDoing(Commitment $commitment) : bool
    {
        return $this->getAdapter()->superviseDoing($commitment);
    }

    public function superviseDone(Commitment $commitment) : bool
    {
        return $this->getAdapter()->superviseDone($commitment);
    }
}
