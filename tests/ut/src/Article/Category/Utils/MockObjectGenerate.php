<?php
namespace Sdk\Article\Category\Utils;

use Sdk\Article\Category\Model\Category;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

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
        //parentCategory
        self::generateParentCategory($category, $value, $faker);
        //style
        self::generateStyle($category, $value, $faker);
        //level
        self::generateLevel($category, $value, $faker);
        //diyContent
        self::generateDiyContent($category, $value, $faker);
        //staff
        self::generateStaff($category, $value, $faker);

        $category->setStatus(0);
        $category->setCreateTime($faker->unixTime());
        $category->setUpdateTime($faker->unixTime());
        $category->setStatusTime($faker->unixTime());

        return $category;
    }

    private static function generateLevel(Category $category, $value, $faker) : void
    {
        $level = isset($value['level']) ?
            $value['level'] :
            $faker->randomElement(
                Category::LEVEL
            );
        $category->setLevel($level);
    }

    private static function generateStyle(Category $category, $value, $faker) : void
    {
        $style = isset($value['style']) ?
            $value['style'] :
            $faker->randomElement(
                Category::STYLE
            );
        $category->setStyle($style);
    }

    private static function generateDiyContent(Category $category, $value, $faker) : void
    {
        $diyContent = isset($value['diyContent']) ? $value['diyContent'] : [$faker->name()];
        
        $category->setDiyContent($diyContent);
    }

    private static function generateStaff(Category $category, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $category->setStaff($staff);
    }

    private static function generateParentCategory(Category $category, $value, $faker) : void
    {
        $id = isset($value['parentCategoryId']) ? $value['parentCategoryId'] : $faker->randomDigitNotNull();
        $name = isset($value['parentCategoryName']) ? $value['parentCategoryName'] : $faker->name();
        $category->setParentCategoryId($id);
        $category->setParentCategoryName($name);
    }
}
