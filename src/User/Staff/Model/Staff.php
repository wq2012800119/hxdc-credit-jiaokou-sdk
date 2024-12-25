<?php
namespace Sdk\User\Staff\Model;

use Sdk\User\Model\User;
use Sdk\User\Staff\Repository\StaffRepository;

use Sdk\Organization\Department\Model\Department;
use Sdk\Organization\Organization\Model\Organization;

abstract class Staff extends User
{
    /**
     * 用户类型
     * SUPER_USER => 1, 超级用户
     * SYSTEM_USER => 2, 系统用户
     * ORGANIZATION_USER => 3 委办局用户
     */
    const CATEGORY = array(
        'SUPER_USER' => 1,
        'SYSTEM_USER' => 2,
        'ORGANIZATION_USER' => 3
    );
    const CATEGORY_CN = array(
        self::CATEGORY['SUPER_USER'] => '超级用户',
        self::CATEGORY['SYSTEM_USER'] => '系统用户',
        self::CATEGORY['ORGANIZATION_USER'] => '委办局用户'
    );

    const POLYMORPHISM_STAFF_MAPPING = array(
        self::CATEGORY['SUPER_USER'] => 'Sdk\User\Staff\Model\SuperUserStaff',
        self::CATEGORY['SYSTEM_USER'] => 'Sdk\User\Staff\Model\SystemUserStaff',
        self::CATEGORY['ORGANIZATION_USER'] => 'Sdk\User\Staff\Model\OrganizationUserStaff'
    );

    /**
     * @var int $category 用户类型
     */
    private $category;
    /**
     * @var array $purview 权限范围
     */
    private $purview;
    /**
     * @var array $roles 角色
     */
    private $roles;
    /**
     * @var Organization $organization 所属委办局
     */
    private $organization;
    /**
     * @var Department $department 所属科室
     */
    private $department;
    /**
     * @var int $identification 身份标识
     */
    private $identification;
    /**
     * @var array $navigation 快捷导航
     */
    private $navigation;

    private $repository;

    private $staffJwtAuth;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->category = 0;
        $this->purview = array();
        $this->navigation = array();
        $this->roles = array();
        $this->identification = '';
        $this->organization = new Organization();
        $this->department = new Department();
        $this->repository = new StaffRepository();
        $this->staffJwtAuth = new StaffJwtAuth();
    }

    public function __destruct()
    {
        unset($this->category);
        unset($this->purview);
        unset($this->navigation);
        unset($this->roles);
        unset($this->organization);
        unset($this->department);
        unset($this->identification);
        unset($this->repository);
        unset($this->staffJwtAuth);
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setPurview(array $purview): void
    {
        $this->purview = $purview;
    }

    public function getPurview(): array
    {
        return $this->purview;
    }

    public function setNavigation(array $navigation): void
    {
        $this->navigation = $navigation;
    }

    public function getNavigation(): array
    {
        return $this->navigation;
    }
    
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }

    public function setIdentification(string $identification): void
    {
        $this->identification = $identification;
    }

    public function getIdentification(): string
    {
        return $this->identification;
    }
    
    protected function getRepository() : StaffRepository
    {
        return $this->repository;
    }

    protected function getStaffJwtAuth() : StaffJwtAuth
    {
        return $this->staffJwtAuth;
    }

    public static function create(int $category = 0) : Staff
    {
        $staff = isset(self::POLYMORPHISM_STAFF_MAPPING[$category]) ?
                    self::POLYMORPHISM_STAFF_MAPPING[$category] :
                    '';

        return class_exists($staff) ? new $staff : NullStaff::getInstance();
    }

    public function login() : bool
    {
        return $this->getRepository()->login($this)
            && $this->getStaffJwtAuth()->generateJwtAndSaveStaffToCache($this);
    }

    public function logout() : bool
    {
        return $this->getStaffJwtAuth()->clearJwtAndStaffToCache($this);
    }

    public function navigation() : bool
    {
        return $this->getRepository()->navigation($this);
    }
}
