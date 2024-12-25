<?php
namespace Sdk\User\Staff\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\User\Staff\Model\Staff;
use Sdk\Role\Purview\Model\IPurviewAble;

class StaffWidgetRule
{
    public function category($category) : bool
    {
        if (!V::numeric()->positive()->validate($category) || !in_array($category, Staff::CATEGORY)) {
            Core::setLastError(STAFF_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function roles($roles) : bool
    {
        if (!V::arrayType()->validate($roles)) {
            Core::setLastError(STAFF_ROLES_FORMAT_INCORRECT);
            return false;
        }

        foreach ($roles as $role) {
            if (!V::numeric()->positive()->validate($role)) {
                Core::setLastError(STAFF_ROLES_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    const NAVIGATION_COUNT = 6;
    public function navigation($navigation) : bool
    {
        if (!V::arrayType()->validate($navigation)) {
            Core::setLastError(STAFF_NAVIGATION_FORMAT_INCORRECT);
            return false;
        }

        if (count($navigation) != self::NAVIGATION_COUNT) {
            Core::setLastError(STAFF_NAVIGATION_FORMAT_INCORRECT);
            return false;
        }

        foreach ($navigation as $column) {
            if (!V::numeric()->positive()->validate($column) || !in_array($column, IPurviewAble::COLUMN)) {
                Core::setLastError(STAFF_NAVIGATION_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }
}
