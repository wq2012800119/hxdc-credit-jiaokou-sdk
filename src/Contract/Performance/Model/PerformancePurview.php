<?php
namespace Sdk\Contract\Performance\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class PerformancePurview extends Purview
{
    const CONTRACT_PERFORMANCE_COLUMNS = array(
        IPurviewAble::COLUMN['CONTRACT_PERFORMANCE'],
        IPurviewAble::COLUMN['CONTRACT_PERFORMANCE_SEARCH'],
        IPurviewAble::COLUMN['CONTRACT_PERFORMANCE_SUPERVISE'],
        IPurviewAble::COLUMN['CONTRACT_PERFORMANCE_EARLY_WARNING']
    );

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['CONTRACT_PERFORMANCE']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();

        foreach (self::CONTRACT_PERFORMANCE_COLUMNS as $dataColumn) {
            if (isset($staffPurview[$dataColumn])) {
                return true;
            }
        }

        return false;
    }

    public function add() : bool
    {
        return $this->operation('add');
    }
    
    public function batchUpload() : bool
    {
        return $this->operation('batchUpload');
    }
    
    public function export() : bool
    {
        return $this->operationColumns('export', self::CONTRACT_PERFORMANCE_COLUMNS);
    }

    public function fulfillment() : bool
    {
        return $this->operation('fulfillment', IPurviewAble::COLUMN['CONTRACT_PERFORMANCE_SUPERVISE']);
    }

    public function breach() : bool
    {
        return $this->operation('breach', IPurviewAble::COLUMN['CONTRACT_PERFORMANCE_SUPERVISE']);
    }

    public function ignoreWarning() : bool
    {
        return $this->operation('ignoreWarning', IPurviewAble::COLUMN['CONTRACT_PERFORMANCE_EARLY_WARNING']);
    }
}
