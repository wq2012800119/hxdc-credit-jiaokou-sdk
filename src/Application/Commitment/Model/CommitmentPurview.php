<?php
namespace Sdk\Application\Commitment\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CommitmentPurview extends Purview
{
    const COMMITMENT_COLUMNS = array(
        IPurviewAble::COLUMN['COMMITMENT'],
        IPurviewAble::COLUMN['COMMITMENT_SEARCH'],
        IPurviewAble::COLUMN['COMMITMENT_SUPERVISE'],
        IPurviewAble::COLUMN['COMMITMENT_EARLY_WARNING'],
        IPurviewAble::COLUMN['COMMITMENT_FILE'],
        IPurviewAble::COLUMN['COMMITMENT_EXAMINE']
    );

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['COMMITMENT']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();

        foreach (self::COMMITMENT_COLUMNS as $dataColumn) {
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

    public function edit() : bool
    {
        return $this->operation('edit');
    }
    
    public function batchUpload() : bool
    {
        return $this->operation('batchUpload');
    }

    public function export() : bool
    {
        return $this->operationColumns('export', self::COMMITMENT_COLUMNS);
    }

    public function superviseDoing() : bool
    {
        return $this->operation('superviseDoing', IPurviewAble::COLUMN['COMMITMENT_SUPERVISE']);
    }

    public function superviseDone() : bool
    {
        return $this->operation('superviseDone', IPurviewAble::COLUMN['COMMITMENT_SUPERVISE']);
    }

    public function enable() : bool
    {
        return $this->operation('enable', IPurviewAble::COLUMN['COMMITMENT_FILE']);
    }

    public function disable() : bool
    {
        return $this->operation('disable', IPurviewAble::COLUMN['COMMITMENT_FILE']);
    }

    public function approve() : bool
    {
        return $this->operation('approve', IPurviewAble::COLUMN['COMMITMENT_EXAMINE']);
    }

    public function reject() : bool
    {
        return $this->operation('reject', IPurviewAble::COLUMN['COMMITMENT_EXAMINE']);
    }
}
