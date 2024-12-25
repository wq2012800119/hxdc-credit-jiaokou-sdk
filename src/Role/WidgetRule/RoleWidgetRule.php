<?php
namespace Sdk\Role\WidgetRule;

use Marmot\Core;

use Respect\Validation\Validator as V;

use Sdk\Role\Purview\Model\IPurviewAble;

class RoleWidgetRule
{
    public function purview($purview) : bool
    {
        if (!V::arrayType()->validate($purview)) {
            Core::setLastError(ROLE_PURVIEW_FORMAT_INCORRECT);
            return false;
        }

        foreach ($purview as $each) {
            if (!isset($each['id']) || !isset($each['actions'])) {
                Core::setLastError(ROLE_PURVIEW_FORMAT_INCORRECT);
                return false;
            }
            $id = $each['id'];
            $actions = $each['actions'];

            if (!is_numeric($id) || !is_numeric($actions)) {
                Core::setLastError(ROLE_PURVIEW_FORMAT_INCORRECT);
                return false;
            }

            if (!in_array($id, IPurviewAble::COLUMN)) {
                Core::setLastError(ROLE_PURVIEW_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }
}
