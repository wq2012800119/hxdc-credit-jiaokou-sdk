<?php
namespace Sdk\Interaction\Complaint\Model;

use Sdk\Interaction\Complaint\Repository\ComplaintRepository;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

use Sdk\Resource\Enterprise\Model\Enterprise;

class Complaint extends CommonInteraction
{
    /**
     * @var Enterprise $enterprise 企业
     */
    private $enterprise;
    /**
     * @var array $evidences 佐证材料
     */
    private $evidences;

    private $repository;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->enterprise = new Enterprise();
        $this->evidences = array();
        $this->repository = new ComplaintRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->enterprise);
        unset($this->evidences);
        unset($this->repository);
    }

    public function setEnterprise(Enterprise $enterprise): void
    {
        $this->enterprise = $enterprise;
    }

    public function getEnterprise(): Enterprise
    {
        return $this->enterprise;
    }

    public function setEvidences(array $evidences): void
    {
        $this->evidences = $evidences;
    }

    public function getEvidences(): array
    {
        return $this->evidences;
    }

    protected function getRepository() : ComplaintRepository
    {
        return $this->repository;
    }
}
