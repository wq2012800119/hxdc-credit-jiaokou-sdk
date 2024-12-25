<?php
namespace Sdk\User\Member\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Adapter\Member\IMemberAdapter;
use Sdk\User\Member\Adapter\Member\MemberMockAdapter;
use Sdk\User\Member\Adapter\Member\MemberRestfulAdapter;

class MemberRepository extends CommonRepository implements IMemberAdapter
{
    const LIST_MODEL_UN = 'MEMBER_LIST';
    const FETCH_ONE_MODEL_UN = 'MEMBER_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new MemberRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new MemberMockAdapter()
        );
    }

    public function login(Member $member) : bool
    {
        return $this->getAdapter()->login($member);
    }

    public function resetPassword(Member $member) : bool
    {
        return $this->getAdapter()->resetPassword($member);
    }

    public function updatePassword(Member $member) : bool
    {
        return $this->getAdapter()->updatePassword($member);
    }

    public function validateAnswer(Member $member) : bool
    {
        return $this->getAdapter()->validateAnswer($member);
    }

    public function updateSecurityQuestion(Member $member) : bool
    {
        return $this->getAdapter()->updateSecurityQuestion($member);
    }
}
