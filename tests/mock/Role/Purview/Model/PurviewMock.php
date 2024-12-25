<?php
namespace Sdk\Role\Purview\Model;

class PurviewMock extends Purview
{
    public function operationPublic($method, $column = 0) : bool
    {
        return parent::operation($method, $column);
    }

    public function fetchStaffPurviewPublic() : array
    {
        return parent::fetchStaffPurview();
    }
}
