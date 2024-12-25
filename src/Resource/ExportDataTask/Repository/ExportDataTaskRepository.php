<?php
namespace Sdk\Resource\ExportDataTask\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\IExportDataTaskAdapter;
use Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\ExportDataTaskMockAdapter;
use Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\ExportDataTaskRestfulAdapter;

class ExportDataTaskRepository extends CommonRepository implements IExportDataTaskAdapter
{
    const LIST_MODEL_UN = 'EXPORT_DATA_TASK_LIST';
    const FETCH_ONE_MODEL_UN = 'EXPORT_DATA_TASK_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ExportDataTaskRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ExportDataTaskMockAdapter()
        );
    }
}
