<?php
namespace Sdk\User\Staff\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Adapter\Staff\IStaffAdapter;
use Sdk\User\Staff\Adapter\Staff\StaffMockAdapter;
use Sdk\User\Staff\Adapter\Staff\StaffRestfulAdapter;

class StaffRepository extends CommonRepository implements IStaffAdapter
{
    const LIST_MODEL_UN = 'STAFF_LIST';
    const FETCH_ONE_MODEL_UN = 'STAFF_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new StaffRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new StaffMockAdapter()
        );
    }

    public function login(Staff $staff) : bool
    {
        return $this->getAdapter()->login($staff);
    }

    public function resetPassword(Staff $staff) : bool
    {
        return $this->getAdapter()->resetPassword($staff);
    }

    public function updatePassword(Staff $staff) : bool
    {
        return $this->getAdapter()->updatePassword($staff);
    }

    public function navigation(Staff $staff) : bool
    {
        return $this->getAdapter()->navigation($staff);
    }
}
