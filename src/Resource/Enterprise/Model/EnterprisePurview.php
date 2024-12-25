<?php
namespace Sdk\Resource\Enterprise\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class EnterprisePurview extends Purview
{
    const ENTERPRISE_COLUMNS = array(
        IPurviewAble::COLUMN['RESOURCE_LEGAL_PERSON_CREDIT_RECORD'],
        IPurviewAble::COLUMN['RESOURCE_SOCIETY_CREDIT_RECORD'],
        IPurviewAble::COLUMN['RESOURCE_CAUSE_UNIT_CREDIT_RECORD'],
        IPurviewAble::COLUMN['CREDIT_REPORT_AUTHORIZE'],
    );

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['RESOURCE_LEGAL_PERSON_CREDIT_RECORD']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();

        foreach (self::ENTERPRISE_COLUMNS as $dataColumn) {
            if (isset($staffPurview[$dataColumn])) {
                return true;
            }
        }

        return false;
    }

    public function authorize() : bool
    {
        $authorizeColumn = IPurviewAble::COLUMN['CREDIT_REPORT_AUTHORIZE'];

        return $this->operation('authorize', $authorizeColumn);
    }

    public function unAuthorize() : bool
    {
        $unAuthorizeColumn = IPurviewAble::COLUMN['CREDIT_REPORT_AUTHORIZE'];

        return $this->operation('unAuthorize', $unAuthorizeColumn);
    }
}
