<?php
namespace Sdk\Resource\Directory\Utils;

use Sdk\Resource\Directory\Model\Template;
use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\DirectorySnapshot;

use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class MockObjectGenerate
{
    protected static function generateCommon($directory, $value, $faker)
    {
        //name
        self::generateName($directory, $value, $faker);
        //identify
        self::generateIdentify($directory, $value, $faker);
        //subjectCategory
        self::generateSubjectCategory($directory, $value, $faker);
        //infoCategory
        self::generateInfoCategory($directory, $value, $faker);
        //sourceUnits
        self::generateSourceUnits($directory, $value, $faker);
        //description
        self::generateDescription($directory, $value, $faker);
        //items
        self::generateItems($directory, $value, $faker);
        //organization
        self::generateOrganization($directory, $value, $faker);
        //staff
        self::generateStaff($directory, $value, $faker);
        //version
        self::generateVersion($directory, $value, $faker);
        //versionDescription
        self::generateVersionDescription($directory, $value, $faker);
        //status
        self::generateStatus($directory, $value, $faker);
        //examineStatus
        self::generateExamineStatus($directory, $value, $faker);

        $directory->setCreateTime($faker->unixTime());
        $directory->setUpdateTime($faker->unixTime());
        $directory->setStatusTime($faker->unixTime());

        return $directory;
    }

    public static function generateDirectory(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Directory {

        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $directory = new Directory($id);
        $directory->setId($id);

        $directory = self::generateCommon($directory, $value, $faker);

        return $directory;
    }

    public static function generateTemplate(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Template {

        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $template = new Template($id);
        $template->setId($id);

        //name
        $name = isset($value['name']) ? $value['name'] : $faker->name();
        $template->setName($name);

        //path
        $path = isset($value['path']) ? $value['path'] : $faker->word();
        $template->setPath($path);

        return $template;
    }

    public static function generateSnapshot(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : DirectorySnapshot {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $snapshot = new DirectorySnapshot($id);
        $snapshot->setId($id);

        //setDirectoryId
        $setDirectoryId = isset($value['setDirectoryId']) ? $value['setDirectoryId'] : $faker->randomDigitNotNull();
        $snapshot->setDirectoryId($setDirectoryId);
        
        $snapshot = self::generateCommon($snapshot, $value, $faker);

        return $snapshot;
    }

    private static function generateName(Directory $directory, array $value, $faker) :void
    {
        //name
        $name = isset($value['name']) ? $value['name'] : $faker->name();
        $directory->setName($name);
    }

    private static function generateIdentify(Directory $directory, array $value, $faker) :void
    {
        //identify
        $identify = isset($value['identify']) ? $value['identify'] : $faker->bothify('##################');
        $directory->setIdentify($identify);
    }

    private static function generateSubjectCategory(Directory $directory, array $value, $faker) : void
    {
        $subjectCategory = isset($value['subjectCategory']) ?
            $value['subjectCategory'] :
            $faker->randomElements(
                Directory::SUBJECT_CATEGORY
            );
        $directory->setSubjectCategory($subjectCategory);
    }
    
    private static function generateInfoCategory(Directory $directory, array $value, $faker) : void
    {
        $infoCategory = isset($value['infoCategory']) ?
            $value['infoCategory'] :
            $faker->randomElement(
                Directory::INFO_CATEGORY
            );
        $directory->setInfoCategory($infoCategory);
    }

    private static function generateSourceUnits(Directory $directory, array $value, $faker) :void
    {
        //organization
        $organization = isset($value['organization']) ?
                        $value['organization'] :
                        OrganizationMockObjectGenerate::generateOrganization($faker->randomDigitNotNull());

        $directory->addSourceUnit($organization);
    }

    private static function generateDescription(Directory $directory, array $value, $faker) :void
    {
        //description
        $description = isset($value['description']) ? $value['description'] : $faker->word();
        $directory->setDescription($description);
    }

    private static function generateVersion(Directory $directory, array $value, $faker) :void
    {
        //version
        $version = isset($value['version']) ? $value['version'] : $faker->word();
        $directory->setVersion($version);
    }

    private static function generateVersionDescription(Directory $directory, array $value, $faker) :void
    {
        //versionDescription
        $versionDescription = isset($value['versionDescription']) ? $value['versionDescription'] : $faker->word();
        $directory->setVersionDescription($versionDescription);
    }

    private static function generateItems(Directory $directory, array $value, $faker) :void
    {
        //items
        $items = isset($value['items']) ? $value['items'] : array($faker->word());
        $directory->setItems($items);
    }

    private static function generateOrganization(Directory $directory, array $value, $faker) :void
    {
        //organization
        $organization = isset($value['organization']) ?
                        $value['organization'] :
                        OrganizationMockObjectGenerate::generateOrganization($faker->randomDigitNotNull());

        $directory->setOrganization($organization);
    }

    private static function generateStaff(Directory $directory, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $directory->setStaff($staff);
    }
    
    private static function generateStatus(Directory $directory, array $value, $faker) : void
    {
        $status = isset($value['status']) ?
            $value['status'] :
            $faker->randomElement(
                Directory::STATUS
            );
        $directory->setStatus($status);
    }
    
    private static function generateExamineStatus(Directory $directory, array $value, $faker) : void
    {
        $examineStatus = isset($value['examineStatus']) ?
            $value['examineStatus'] :
            $faker->randomElement(
                Directory::EXAMINE_STATUS
            );
        $directory->setExamineStatus($examineStatus);
    }
}
