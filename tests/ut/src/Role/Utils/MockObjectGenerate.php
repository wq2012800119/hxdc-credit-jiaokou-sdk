<?php
namespace Sdk\Role\Utils;

use Sdk\Role\Model\Role;

class MockObjectGenerate
{
    public static function generateRole(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Role {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $role = new Role($id);
        $role->setId($id);

        //name
        self::generateName($role, $value, $faker);
        //purview
        self::generatePurview($role, $value, $faker);

        $role->setStatus(0);
        $role->setCreateTime($faker->unixTime());
        $role->setUpdateTime($faker->unixTime());
        $role->setStatusTime($faker->unixTime());

        return $role;
    }

    private static function generateName(Role $role, array $value, $faker) :void
    {
        //name
        $name = isset($value['name']) ? $value['name'] : $faker->word();
        $role->setName($name);
    }

    private static function generatePurview(Role $role, array $value, $faker) :void
    {
        //purview
        $purview = isset($value['purview']) ? $value['purview'] : [$faker->word()];
        $role->setPurview($purview);
    }
}
