<?php
namespace Sdk\Interaction\Appeal\Model;

use Sdk\Interaction\Appeal\Repository\AppealRepository;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

use Sdk\Resource\Data\Model\Data;

class Appeal extends CommonInteraction
{
    /**
     * @var Data $data 信用数据
     */
    private $data;
    /**
     * @var array $evidences 佐证材料
     */
    private $evidences;

    private $repository;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->data = new Data();
        $this->evidences = array();
        $this->repository = new AppealRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->data);
        unset($this->evidences);
        unset($this->repository);
    }

    public function setData(Data $data): void
    {
        $this->data = $data;
    }

    public function getData(): Data
    {
        return $this->data;
    }

    public function setEvidences(array $evidences): void
    {
        $this->evidences = $evidences;
    }

    public function getEvidences(): array
    {
        return $this->evidences;
    }

    protected function getRepository() : AppealRepository
    {
        return $this->repository;
    }
}
