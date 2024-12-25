<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Utils;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateHelpPageConfig(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : HelpPageConfig {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $helpPageConfig = new HelpPageConfig($id);
        $helpPageConfig->setId($id);

        //title
        $title = isset($value['title']) ? $value['title'] : $faker->title();
        $helpPageConfig->setTitle($title);
        //style
        self::generateStyle($helpPageConfig, $value, $faker);
        //diyContent
        self::generateDiyContent($helpPageConfig, $value, $faker);
        //staff
        self::generateStaff($helpPageConfig, $value, $faker);

        $helpPageConfig->setStatus(0);
        $helpPageConfig->setCreateTime($faker->unixTime());
        $helpPageConfig->setUpdateTime($faker->unixTime());
        $helpPageConfig->setStatusTime($faker->unixTime());

        return $helpPageConfig;
    }

    private static function generateStyle(HelpPageConfig $helpPageConfig, $value, $faker) : void
    {
        $style = isset($value['style']) ?
            $value['style'] :
            $faker->randomElement(
                HelpPageConfig::STYLE
            );
        $helpPageConfig->setStyle($style);
    }

    private static function generateDiyContent(HelpPageConfig $helpPageConfig, $value, $faker) : void
    {
        $diyContent = isset($value['diyContent']) ? $value['diyContent'] : [$faker->name()];
        
        $helpPageConfig->setDiyContent($diyContent);
    }

    private static function generateStaff(HelpPageConfig $helpPageConfig, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $helpPageConfig->setStaff($staff);
    }
}
