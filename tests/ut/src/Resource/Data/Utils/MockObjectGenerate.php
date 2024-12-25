<?php
namespace Sdk\Resource\Data\Utils;

use Sdk\Resource\Data\Model\Data;
use Sdk\Resource\Directory\Model\Directory;

use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;
use Sdk\Resource\Directory\Utils\MockObjectGenerate as DirectoryMockObjectGenerate;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateCommon($data, $value, $faker)
    {
        //subjectName
        self::generateSubjectName($data, $value, $faker);
        //identify
        self::generateIdentify($data, $value, $faker);
        //subjectCategory
        self::generateSubjectCategory($data, $value, $faker);
        //infoCategory
        self::generateInfoCategory($data, $value, $faker);
        //publicationRange
        self::generatePublicationRange($data, $value, $faker);
        //expireDate
        self::generateExpireDate($data, $value, $faker);
        //exchangeSyncStatus
        self::generateExchangeSyncStatus($data, $value, $faker);
        //internalSyncStatus
        self::generateInternalSyncStatus($data, $value, $faker);
        //items
        self::generateItems($data, $value, $faker);
        //organization
        self::generateOrganization($data, $value, $faker);
        //staff
        self::generateStaff($data, $value, $faker);
        //directoryAndDirectorySnapshot
        self::generateDirectoryAndDirectorySnapshot($data, $value, $faker);
        //status
        self::generateStatus($data, $value, $faker);
        //examineStatus
        self::generateExamineStatus($data, $value, $faker);

        $data->setCreateTime($faker->unixTime());
        $data->setUpdateTime($faker->unixTime());
        $data->setStatusTime($faker->unixTime());

        return $data;
    }

    public static function generateData(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Data {

        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $data = new Data($id);
        $data->setId($id);

        $data = self::generateCommon($data, $value, $faker);

        return $data;
    }

    private static function generateSubjectName(Data $data, array $value, $faker) :void
    {
        //subjectName
        $subjectName = isset($value['subjectName']) ? $value['subjectName'] : $faker->name();
        $data->setSubjectName($subjectName);
    }

    private static function generateIdentify(Data $data, array $value, $faker) :void
    {
        //identify
        $identify = isset($value['identify']) ? $value['identify'] : $faker->bothify('##################');
        $data->setIdentify($identify);
    }

    private static function generateSubjectCategory(Data $data, array $value, $faker) : void
    {
        $subjectCategory = isset($value['subjectCategory']) ?
            $value['subjectCategory'] :
            $faker->randomElement(
                Directory::SUBJECT_CATEGORY
            );
        $data->setSubjectCategory($subjectCategory);
    }
    
    private static function generateInfoCategory(Data $data, array $value, $faker) : void
    {
        $infoCategory = isset($value['infoCategory']) ?
            $value['infoCategory'] :
            $faker->randomElement(
                Directory::INFO_CATEGORY
            );
        $data->setInfoCategory($infoCategory);
    }
    
    private static function generatePublicationRange(Data $data, array $value, $faker) : void
    {
        $publicationRange = isset($value['publicationRange']) ?
            $value['publicationRange'] :
            $faker->randomElement(
                Directory::PUBLICATION_RANGE
            );
        $data->setPublicationRange($publicationRange);
    }

    private static function generateExpireDate(Data $data, array $value, $faker) :void
    {
        //expireDate
        $expireDate = isset($value['expireDate']) ? $value['expireDate'] : $faker->unixTime();
        $data->setExpireDate($expireDate);
    }

    private static function generateExchangeSyncStatus(Data $data, array $value, $faker) :void
    {
        //exchangeSyncStatus
        $exchangeSyncStatus = isset($value['exchangeSyncStatus']) ?
                                $value['exchangeSyncStatus'] :
                                $faker->randomDigitNotNull();
        $data->setExchangeSyncStatus($exchangeSyncStatus);
    }

    private static function generateInternalSyncStatus(Data $data, array $value, $faker) :void
    {
        //internalSyncStatus
        $internalSyncStatus = isset($value['internalSyncStatus']) ?
                                $value['internalSyncStatus'] :
                                $faker->randomDigitNotNull();
        $data->setInternalSyncStatus($internalSyncStatus);
    }
    
    private static function generateItems(Data $data, array $value, $faker) :void
    {
        //items
        $items = isset($value['items']) ? $value['items'] : array($faker->word());
        $data->setItems($items);
    }

    private static function generateOrganization(Data $data, array $value, $faker) :void
    {
        //organization
        $organization = isset($value['organization']) ?
                        $value['organization'] :
                        OrganizationMockObjectGenerate::generateOrganization($faker->randomDigitNotNull());

        $data->setOrganization($organization);
    }

    private static function generateStaff(Data $data, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $data->setStaff($staff);
    }

    private static function generateDirectoryAndDirectorySnapshot(Data $data, array $value, $faker) :void
    {
        //directory
        $directory = isset($value['directory']) ?
                        $value['directory'] :
                        DirectoryMockObjectGenerate::generateDirectory($faker->randomDigitNotNull());
        //snapshot
        $snapshot = isset($value['directorySnapshot']) ?
                        $value['directorySnapshot'] :
                        DirectoryMockObjectGenerate::generateSnapshot($faker->randomDigitNotNull());

        $data->setDirectory($directory);
        $data->setDirectorySnapshot($snapshot);
    }
    
    private static function generateStatus(Data $data, array $value, $faker) : void
    {
        $status = isset($value['status']) ?
            $value['status'] :
            $faker->randomElement(
                Data::STATUS
            );
        $data->setStatus($status);
    }
    
    private static function generateExamineStatus(Data $data, array $value, $faker) : void
    {
        $examineStatus = isset($value['examineStatus']) ?
            $value['examineStatus'] :
            $faker->randomElement(
                Data::EXAMINE_STATUS
            );
        $data->setExamineStatus($examineStatus);
    }
}
