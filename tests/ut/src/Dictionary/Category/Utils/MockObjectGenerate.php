<?php
namespace Sdk\Dictionary\Category\Utils;

use Sdk\Dictionary\Category\Model\Category;

class MockObjectGenerate
{
    public static function generateCategory(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Category {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $category = new Category($id);
        $category->setId($id);

        //name
        $name = isset($value['name']) ? $value['name'] : $faker->word();

        $category->setName($name);
        $category->setStatus(0);
        $category->setCreateTime($faker->unixTime());
        $category->setUpdateTime($faker->unixTime());
        $category->setStatusTime($faker->unixTime());

        return $category;
    }
}
