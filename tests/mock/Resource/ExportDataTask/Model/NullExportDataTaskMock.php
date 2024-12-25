<?php
namespace Sdk\Resource\ExportDataTask\Model;

class NullExportDataTaskMock extends NullExportDataTask
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}
