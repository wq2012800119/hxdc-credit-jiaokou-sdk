<?php
namespace Sdk\Organization\Organization\Utils;

use Sdk\Organization\Organization\Model\Organization;
use Sdk\Dictionary\Item\Utils\MockObjectGenerate as ItemMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateOrganization(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Organization {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $organization = new Organization($id);
        $organization->setId($id);

        //name
        self::generateName($organization, $value, $faker);
        //shortName
        self::generateShortName($organization, $value, $faker);
        //unifiedIdentifier
        self::generateUnifiedIdentifier($organization, $value, $faker);
        //jurisdictionArea
        self::generateJurisdictionArea($organization, $value, $faker);

        $organization->setStatus(0);
        $organization->setCreateTime($faker->unixTime());
        $organization->setUpdateTime($faker->unixTime());
        $organization->setStatusTime($faker->unixTime());

        return $organization;
    }

    private static function generateName(Organization $organization, array $value, $faker) :void
    {
        //name
        $name = isset($value['name']) ? $value['name'] : $faker->word();
        $organization->setName($name);
    }

    private static function generateShortName(Organization $organization, array $value, $faker) :void
    {
        //shortName
        $shortName = isset($value['shortName']) ? $value['shortName'] : $faker->word();
        $organization->setShortName($shortName);
    }

    private static function generateUnifiedIdentifier(Organization $organization, array $value, $faker) :void
    {
        //unifiedIdentifier
        $unifiedIdentifier = isset($value['unifiedIdentifier']) ?
                                $value['unifiedIdentifier'] :
                                $faker->bothify('###################');
        $organization->setUnifiedIdentifier($unifiedIdentifier);
    }

    private static function generateJurisdictionArea(Organization $organization, array $value, $faker) :void
    {
        //jurisdictionArea
        $jurisdictionArea = isset($value['jurisdictionArea']) ?
                        $value['jurisdictionArea'] :
                        ItemMockObjectGenerate::generateItem($faker->randomDigitNotNull());

        $organization->setJurisdictionArea($jurisdictionArea);
    }
}
