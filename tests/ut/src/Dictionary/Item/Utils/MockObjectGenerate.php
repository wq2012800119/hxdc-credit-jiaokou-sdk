<?php
namespace Sdk\Dictionary\Item\Utils;

use Sdk\Dictionary\Item\Model\Item;
use Sdk\Dictionary\Category\Utils\MockObjectGenerate as CategoryMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateItem(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Item {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $item = new Item($id);
        $item->setId($id);

        //name
        $name = isset($value['name']) ? $value['name'] : $faker->word();
        $item->setName($name);

        //category
        $category = isset($value['category']) ?
                    $value['category'] :
                    CategoryMockObjectGenerate::generateCategory($faker->randomDigitNotNull());
        $item->setCategory($category);

        $item->setStatus(0);
        $item->setCreateTime($faker->unixTime());
        $item->setUpdateTime($faker->unixTime());
        $item->setStatusTime($faker->unixTime());

        return $item;
    }
}
