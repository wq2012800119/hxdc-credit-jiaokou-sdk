<?php
namespace Sdk\Resource\UploadDataTask\Utils;

use Sdk\Resource\UploadDataTask\Model\Template;
use Sdk\Resource\UploadDataTask\Model\UploadDataTask;
use Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord;

use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;
use Sdk\Resource\Directory\Utils\MockObjectGenerate as DirectoryMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateUploadDataTask(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : UploadDataTask {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $uploadDataTask = new UploadDataTask($id);
        $uploadDataTask->setId($id);

        //name
        self::generateName($uploadDataTask, $value, $faker);
        //exportFileName
        self::generateExportFileName($uploadDataTask, $value, $faker);
        //num
        self::generateNum($uploadDataTask, $value, $faker);
        //executionStatus
        self::generateExecutionStatus($uploadDataTask, $value, $faker);
        //code
        self::generateCode($uploadDataTask, $value, $faker);
        //staffAndOrganization
        self::generateStaffAndOrganization($uploadDataTask, $value, $faker);
        //directoryAndDirectorySnapshot
        self::generateDirectoryAndDirectorySnapshot($uploadDataTask, $value, $faker);
        //status
        self::generateStatus($uploadDataTask, $value, $faker);

        $uploadDataTask->setCreateTime($faker->unixTime());
        $uploadDataTask->setUpdateTime($faker->unixTime());
        $uploadDataTask->setStatusTime($faker->unixTime());

        return $uploadDataTask;
    }

    private static function generateName(UploadDataTask $uploadDataTask, array $value, $faker) :void
    {
        //name
        $name = isset($value['name']) ? $value['name'] : $faker->name();
        $uploadDataTask->setName($name);
    }

    private static function generateExportFileName(UploadDataTask $uploadDataTask, array $value, $faker) :void
    {
        //exportFileName
        $exportFileName = isset($value['exportFileName']) ? $value['exportFileName'] : $faker->name();
        $uploadDataTask->setExportFileName($exportFileName);
    }

    private static function generateNum(UploadDataTask $uploadDataTask, array $value, $faker) : void
    {
        $total = isset($value['total']) ? $value['total'] : $faker->randomDigitNotNull();
        $successNum = isset($value['successNum']) ? $value['successNum'] : rand(0, $total);
        $failNum = isset($value['failNum']) ? $value['failNum'] : $total - $successNum;
        $updatedNum = isset($value['updatedNum']) ? $value['updatedNum'] : $total;

        $uploadDataTask->setTotal($total);
        $uploadDataTask->setSuccessNum($successNum);
        $uploadDataTask->setFailNum($failNum);
        $uploadDataTask->setUpdatedNum($updatedNum);
    }

    private static function generateExecutionStatus(UploadDataTask $uploadDataTask, array $value, $faker) : void
    {
        $executionStatus = isset($value['executionStatus']) ?
            $value['executionStatus'] :
            $faker->randomElement(
                UploadDataTask::EXECUTION_STATUS
            );
        $uploadDataTask->setExecutionStatus($executionStatus);
    }

    private static function generateCode(UploadDataTask $uploadDataTask, array $value, $faker) : void
    {
        $code = isset($value['code']) ?
            $value['code'] :
            $faker->randomElement(
                UploadDataTask::CODE
            );
        $uploadDataTask->setCode($code);
    }

    private static function generateStaffAndOrganization(UploadDataTask $uploadDataTask, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $uploadDataTask->setStaff($staff);
        $uploadDataTask->setOrganization($staff->getOrganization());
    }

    private static function generateDirectoryAndDirectorySnapshot(
        UploadDataTask $uploadDataTask,
        array $value,
        $faker
    ) :void {
        //directory
        $directory = isset($value['directory']) ?
                        $value['directory'] :
                        DirectoryMockObjectGenerate::generateDirectory($faker->randomDigitNotNull());
        $directorySnapshot = isset($value['directorySnapshot']) ?
                        $value['directorySnapshot'] :
                        DirectoryMockObjectGenerate::generateSnapshot($faker->randomDigitNotNull());

        $uploadDataTask->setDirectory($directory);
        $uploadDataTask->setDirectorySnapshot($directorySnapshot);
    }

    private static function generateStatus(UploadDataTask $uploadDataTask, array $value, $faker) : void
    {
        $status = isset($value['status']) ?
            $value['status'] :
            $faker->randomElement(
                UploadDataTask::TASK_STATUS
            );
        $uploadDataTask->setStatus($status);
    }
    
    public static function generateRecord(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : UploadDataTaskRecord {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $record = new UploadDataTaskRecord($id);
        $record->setId($id);

        //index
        self::generateIndex($record, $value, $faker);
        //items
        self::generateItems($record, $value, $faker);
        //errorDescription
        self::generateErrorDescription($record, $value, $faker);
        //failReason
        self::generateFailReason($record, $value, $faker);
        //errorNumber
        self::generateErrorNumber($record, $value, $faker);

        $uploadDataTask = self::generateUploadDataTask($id, $seed);
        $record->setUploadDataTask($uploadDataTask);

        return $record;
    }

    private static function generateIndex(UploadDataTaskRecord $record, array $value, $faker) : void
    {
        $index = isset($value['index']) ? $value['index'] : $faker->randomDigitNotNull();
        $record->setIndex($index);
    }

    private static function generateItems(UploadDataTaskRecord $record, array $value, $faker) :void
    {
        //items
        $items = isset($value['items']) ? $value['items'] : array($faker->word());
        $record->setItems($items);
    }

    private static function generateErrorDescription(UploadDataTaskRecord $record, array $value, $faker) :void
    {
        //errorDescription
        $errorDescription = isset($value['errorDescription']) ? $value['errorDescription'] : array($faker->word());
        $record->setErrorDescription($errorDescription);
    }

    private static function generateFailReason(UploadDataTaskRecord $record, array $value, $faker) :void
    {
        //failReason
        $failReason = isset($value['failReason']) ? $value['failReason'] : array($faker->word());
        $record->setFailReason($failReason);
    }

    private static function generateErrorNumber(UploadDataTaskRecord $record, array $value, $faker) : void
    {
        $errorNumber = isset($value['errorNumber']) ?
            $value['errorNumber'] :
            $faker->randomElement(
                UploadDataTaskRecord::ERROR_NUMBER
            );
        $record->setErrorNumber($errorNumber);
    }
}
