<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Utils;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateHomePageConfig(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : HomePageConfig {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $homePageConfig = new HomePageConfig($id);
        $homePageConfig->setId($id);

        //versionDescription
        $versionDescription = isset($value['versionDescription']) ?
                                $value['versionDescription'] :
                                $faker->word();
        $homePageConfig->setVersionDescription($versionDescription);
        //status
        self::generateStatus($homePageConfig, $value, $faker);
        //diyContent
        self::generateDiyContent($homePageConfig, $value, $faker);
        //staff
        self::generateStaff($homePageConfig, $value, $faker);

        $homePageConfig->setCreateTime($faker->unixTime());
        $homePageConfig->setUpdateTime($faker->unixTime());
        $homePageConfig->setStatusTime($faker->unixTime());

        return $homePageConfig;
    }

    private static function generateStatus(HomePageConfig $homePageConfig, $value, $faker) : void
    {
        $status = isset($value['status']) ?
            $value['status'] :
            $faker->randomElement(
                HomePageConfig::STATUS
            );
        $homePageConfig->setStatus($status);
    }

    private static function generateDiyContent(HomePageConfig $homePageConfig, $value, $faker) : void
    {
        $diyContent = isset($value['diyContent']) ? $value['diyContent'] : [$faker->name()];
        
        $homePageConfig->setDiyContent($diyContent);
    }

    private static function generateStaff(HomePageConfig $homePageConfig, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $homePageConfig->setStaff($staff);
    }
}
