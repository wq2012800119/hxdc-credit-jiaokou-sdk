<?php
namespace Sdk\Statistics\Record\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Statistics\Record\Adapter\Record\IRecordAdapter;
use Sdk\Statistics\Record\Adapter\Record\RecordMockAdapter;
use Sdk\Statistics\Record\Adapter\Record\RecordRestfulAdapter;

class RecordRepository extends CommonRepository implements IRecordAdapter
{
    const LIST_MODEL_UN = 'RECORD_LIST';
    const FETCH_ONE_MODEL_UN = 'RECORD_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new RecordRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new RecordMockAdapter()
        );
    }
}
