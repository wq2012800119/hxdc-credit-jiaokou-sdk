<?php
namespace Sdk\Interaction\Interlocution\Model;

use Sdk\Interaction\Interlocution\Repository\InterlocutionRepository;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

class Interlocution extends CommonInteraction
{
    /**
     * @var string $question 问题描述
     */
    private $question;

    private $repository;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->question = '';
        $this->repository = new InterlocutionRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->question);
        unset($this->repository);
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    protected function getRepository() : InterlocutionRepository
    {
        return $this->repository;
    }
}
