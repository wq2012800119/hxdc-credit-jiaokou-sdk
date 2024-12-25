<?php
namespace Sdk\Resource\UploadDataTask\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\IUploadDataTaskAdapter;
use Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\UploadDataTaskMockAdapter;
use Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\UploadDataTaskRestfulAdapter;

class UploadDataTaskRepository extends CommonRepository implements IUploadDataTaskAdapter
{
    const LIST_MODEL_UN = 'UPLOAD_DATA_TASK_LIST';
    const FETCH_ONE_MODEL_UN = 'UPLOAD_DATA_TASK_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new UploadDataTaskRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new UploadDataTaskMockAdapter()
        );
    }
}
