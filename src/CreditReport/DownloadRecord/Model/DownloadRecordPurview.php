<?php
namespace Sdk\CreditReport\DownloadRecord\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class DownloadRecordPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['CREDIT_REPORT_DOWNLOAD_RECORD']);
    }
}
