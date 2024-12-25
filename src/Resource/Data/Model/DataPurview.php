<?php
namespace Sdk\Resource\Data\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class DataPurview extends Purview
{
    const DATA_COLUMNS = array(
        IPurviewAble::COLUMN['RESOURCE_DATA'],
        IPurviewAble::COLUMN['RESOURCE_DATA_SEARCH'],
        IPurviewAble::COLUMN['RESOURCE_DATA_FILE'],
        IPurviewAble::COLUMN['RESOURCE_DATA_EXAMINE'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION_SEARCH'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION_FILE'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION_EXAMINE'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM_SEARCH'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM_FILE'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM_EXAMINE'],
        IPurviewAble::COLUMN['CIVIL_SERVANT_CREDIT_FILE'],
        IPurviewAble::COLUMN['DOCTOR_CREDIT_FILE'],
        IPurviewAble::COLUMN['LAWYER_CREDIT_FILE'],
        IPurviewAble::COLUMN['TEACHER_CREDIT_FILE'],
        IPurviewAble::COLUMN['RAP_OBJECT_SEARCH'],
        IPurviewAble::COLUMN['CREDIT_MODULE_RESOURCE_DATA']
    );

    const DATA_ADD__BATCH_UPLOAD_COLUMNS = array(
        IPurviewAble::COLUMN['RESOURCE_DATA'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM']
    );

    const DATA_ENABLE_DISABLE_COLUMNS = array(
        IPurviewAble::COLUMN['RESOURCE_DATA_FILE'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION_FILE'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM_FILE'],
    );

    const DATA_APPROVE_REJECT_COLUMNS = array(
        IPurviewAble::COLUMN['RESOURCE_DATA_EXAMINE'],
        IPurviewAble::COLUMN['RESOURCE_PUBLICATION_EXAMINE'],
        IPurviewAble::COLUMN['RESOURCE_RANDOM_EXAMINE'],
    );

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['RESOURCE_DATA']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();

        foreach (self::DATA_COLUMNS as $dataColumn) {
            if (isset($staffPurview[$dataColumn])) {
                return true;
            }
        }

        return false;
    }

    public function add() : bool
    {
        return $this->operationColumns('add', self::DATA_ADD__BATCH_UPLOAD_COLUMNS);
    }
    
    public function enable() : bool
    {
        return $this->operationColumns('enable', self::DATA_ENABLE_DISABLE_COLUMNS);
    }

    public function disable() : bool
    {
        return $this->operationColumns('disable', self::DATA_ENABLE_DISABLE_COLUMNS);
    }

    public function batchUpload() : bool
    {
        return $this->operationColumns('batchUpload', self::DATA_ADD__BATCH_UPLOAD_COLUMNS);
    }

    public function export() : bool
    {
        return $this->operationColumns('export', self::DATA_COLUMNS);
    }

    public function approve() : bool
    {
        return $this->operationColumns('approve', self::DATA_COLUMNS);
    }

    public function reject() : bool
    {
        return $this->operationColumns('reject', self::DATA_COLUMNS);
    }
}
