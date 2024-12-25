<?php
namespace Sdk\Resource\NaturalPerson\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class NaturalPersonPurview extends Purview
{
    const NATURAL_PERSON_COLUMNS = array(
        IPurviewAble::COLUMN['RESOURCE_NATURAL_PERSON_CREDIT_RECORD'],
        IPurviewAble::COLUMN['CREDIT_REPORT_AUTHORIZE'],
    );

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['RESOURCE_NATURAL_PERSON_CREDIT_RECORD']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();
    
        foreach (self::NATURAL_PERSON_COLUMNS as $dataColumn) {
            if (isset($staffPurview[$dataColumn])) {
                return true;
            }
        }
    
        return false;
    }

    public function authorize() : bool
    {
        return $this->operation('authorize', IPurviewAble::COLUMN['CREDIT_REPORT_AUTHORIZE']);
    }
    
    public function unAuthorize() : bool
    {
        return $this->operation('unAuthorize', IPurviewAble::COLUMN['CREDIT_REPORT_AUTHORIZE']);
    }
}
