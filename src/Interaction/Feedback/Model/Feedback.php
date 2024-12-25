<?php
namespace Sdk\Interaction\Feedback\Model;

use Sdk\Interaction\Feedback\Repository\FeedbackRepository;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

class Feedback extends CommonInteraction
{
    private $repository;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->repository = new FeedbackRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->repository);
    }

    protected function getRepository() : FeedbackRepository
    {
        return $this->repository;
    }
}
