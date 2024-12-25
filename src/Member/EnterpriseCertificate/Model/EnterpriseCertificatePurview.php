<?php
namespace Sdk\Member\EnterpriseCertificate\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class EnterpriseCertificatePurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['CERTIFICATE_EXAMINE']);
    }

    public function approve() : bool
    {
        return $this->operation('approve');
    }
    
    public function reject() : bool
    {
        return $this->operation('reject');
    }
}
