<?php
namespace Sdk\CreditReport\DownloadRecord\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditReport\DownloadRecord\Adapter\DownloadRecord\IDownloadRecordAdapter;
use Sdk\CreditReport\DownloadRecord\Adapter\DownloadRecord\DownloadRecordMockAdapter;
use Sdk\CreditReport\DownloadRecord\Adapter\DownloadRecord\DownloadRecordRestfulAdapter;

class DownloadRecordRepository extends CommonRepository implements IDownloadRecordAdapter
{
    const LIST_MODEL_UN = 'DOWNLOAD_RECORD_LIST';
    const FETCH_ONE_MODEL_UN = 'DOWNLOAD_RECORD_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new DownloadRecordRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new DownloadRecordMockAdapter()
        );
    }
}
