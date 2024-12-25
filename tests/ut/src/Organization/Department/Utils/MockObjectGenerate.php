<?php
namespace Sdk\Organization\Department\Utils;

use Sdk\Organization\Department\Model\Department;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateDepartment(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Department {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $department = new Department($id);
        $department->setId($id);

        //name
        $name = isset($value['name']) ? $value['name'] : $faker->word();
        $department->setName($name);

        //organization
        $organization = isset($value['organization']) ?
                        $value['organization'] :
                        OrganizationMockObjectGenerate::generateOrganization($faker->randomDigitNotNull());
        $department->setOrganization($organization);

        $department->setStatus(0);
        $department->setCreateTime($faker->unixTime());
        $department->setUpdateTime($faker->unixTime());
        $department->setStatusTime($faker->unixTime());

        return $department;
    }
}
