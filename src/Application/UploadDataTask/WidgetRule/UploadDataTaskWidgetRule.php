<?php
namespace Sdk\Application\UploadDataTask\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Application\UploadDataTask\Model\UploadDataTask;

class UploadDataTaskWidgetRule
{
    public function category($category) : bool
    {
        if (!V::numeric()->positive()->validate($category) || !in_array($category, UploadDataTask::CATEGORY)) {
            Core::setLastError(APPLICATION_UPLOAD_DATA_TASK_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}
