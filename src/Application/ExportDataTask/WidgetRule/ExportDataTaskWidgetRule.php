<?php
namespace Sdk\Application\ExportDataTask\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Application\ExportDataTask\Model\ExportDataTask;

class ExportDataTaskWidgetRule
{
    public function category($category) : bool
    {
        if (!V::numeric()->positive()->validate($category) || !in_array($category, ExportDataTask::CATEGORY)) {
            Core::setLastError(APPLICATION_EXPORT_DATA_TASK_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}
