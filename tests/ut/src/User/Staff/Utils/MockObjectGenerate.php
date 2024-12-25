<?php
namespace Sdk\User\Staff\Utils;

use Sdk\User\Staff\Model\Staff;

use Sdk\Role\Utils\MockObjectGenerate as RoleMockObjectGenerate;
use Sdk\Organization\Department\Utils\MockObjectGenerate as DepartmentMockObjectGenerate;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateStaff(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Staff {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $category = isset($value['category']) ? $value['category'] : $faker->randomElement(Staff::CATEGORY);
        $staff = Staff::create($category);

        $staff->setId($id);

        //subjectName
        self::generateSubjectName($staff, $value, $faker);
        //cellphone
        self::generateCellphone($staff, $value, $faker);
        //identification
        self::generateIdentification($staff, $value, $faker);
        //idCard
        self::generateIdCard($staff, $value, $faker);
        //password
        self::generatePassword($staff, $value, $faker);
        $staff->setCategory($category);
        //purview
        self::generatePurview($staff, $value, $faker);
        //organization
        self::generateOrganization($staff, $value, $faker);
        //department
        self::generateDepartment($staff, $value, $faker);
        //roles
        self::generateRoles($staff, $value, $faker);
        //status
        self::generateStatus($staff, $value, $faker);
        $staff->setCreateTime($faker->unixTime());
        $staff->setUpdateTime($faker->unixTime());
        $staff->setStatusTime($faker->unixTime());

        return $staff;
    }

    private static function generateSubjectName(Staff $staff, array $value, $faker) :void
    {
        //subjectName
        $subjectName = isset($value['subjectName']) ? $value['subjectName'] : $faker->name();
        $staff->setSubjectName($subjectName);
    }

    private static function generateCellphone(Staff $staff, array $value, $faker) :void
    {
        //cellphone
        $cellphone = isset($value['cellphone']) ? $value['cellphone'] : $faker->phoneNumber();
        $staff->setCellphone($cellphone);
    }

    private static function generateIdentification(Staff $staff, array $value, $faker) :void
    {
        //identification
        $identification = isset($value['identification']) ? $value['identification'] : $faker->name();
        $staff->setIdentification($identification);
    }

    private static function generateIdCard(Staff $staff, array $value, $faker) :void
    {
        //idCard
        $idCard = isset($value['idCard']) ? $value['idCard'] : $faker->bothify('##################');
        $staff->setIdCard($idCard);
    }

    private static function generatePassword(Staff $staff, array $value, $faker) :void
    {
        //password
        $password = isset($value['password']) ? $value['password'] : $faker->bothify('###??@A??');
        $staff->setPassword($password);
    }

    private static function generatePurview(Staff $staff, array $value, $faker) :void
    {
        //purview
        $purview = isset($value['purview']) ? $value['purview'] : array($faker->word());
        $staff->setPurview($purview);
    }

    private static function generateOrganization(Staff $staff, array $value, $faker) :void
    {
        //organization
        $organization = isset($value['organization']) ?
                        $value['organization'] :
                        OrganizationMockObjectGenerate::generateOrganization($faker->randomDigitNotNull());

        $staff->setOrganization($organization);
    }

    private static function generateDepartment(Staff $staff, array $value, $faker) :void
    {
        //department
        $department = isset($value['department']) ?
                        $value['department'] :
                        DepartmentMockObjectGenerate::generateDepartment($faker->randomDigitNotNull());

        $staff->setDepartment($department);
    }

    private static function generateRoles(Staff $staff, array $value, $faker) :void
    {
        //roles
        $roles = isset($value['roles']) ?
                        $value['roles'] :
                        [RoleMockObjectGenerate::generateRole($faker->randomDigitNotNull())];

        $staff->setRoles($roles);
    }
    
    private static function generateStatus(Staff $staff, $value, $faker) : void
    {
        $status = isset($value['status']) ? $value['status'] : $faker->randomElement(Staff::STATUS);

        $staff->setStatus($status);
    }
}
