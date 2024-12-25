<?php
namespace Sdk\Resource\ExportDataTask\Utils;

use Sdk\Resource\ExportDataTask\Model\Template;
use Sdk\Resource\ExportDataTask\Model\ExportDataTask;
use Sdk\Resource\ExportDataTask\Model\ExportDataTaskRecord;

use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;
use Sdk\Resource\Directory\Utils\MockObjectGenerate as DirectoryMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateExportDataTask(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : ExportDataTask {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $exportDataTask = new ExportDataTask($id);
        $exportDataTask->setId($id);

        //exportFileName
        self::generateExportFileName($exportDataTask, $value, $faker);
        //num
        self::generateNum($exportDataTask, $value, $faker);
        //filter
        self::generateFilter($exportDataTask, $value, $faker);
        //sort
        self::generateSort($exportDataTask, $value, $faker);
        //code
        self::generateCode($exportDataTask, $value, $faker);
        //staffAndOrganization
        self::generateStaffAndOrganization($exportDataTask, $value, $faker);
        //directoryAndDirectorySnapshot
        self::generateDirectoryAndDirectorySnapshot($exportDataTask, $value, $faker);
        //status
        self::generateStatus($exportDataTask, $value, $faker);

        $exportDataTask->setCreateTime($faker->unixTime());
        $exportDataTask->setUpdateTime($faker->unixTime());
        $exportDataTask->setStatusTime($faker->unixTime());

        return $exportDataTask;
    }

    private static function generateExportFileName(ExportDataTask $exportDataTask, array $value, $faker) :void
    {
        //exportFileName
        $exportFileName = isset($value['exportFileName']) ? $value['exportFileName'] : $faker->name();
        $exportDataTask->setExportFileName($exportFileName);
    }

    private static function generateFilter(ExportDataTask $exportDataTask, array $value, $faker) :void
    {
        //filter
        $filter = isset($value['filter']) ? $value['filter'] : [$faker->word()];
        $exportDataTask->setFilter($filter);
    }

    private static function generateSort(ExportDataTask $exportDataTask, array $value, $faker) :void
    {
        //sort
        $sort = isset($value['sort']) ? $value['sort'] : $faker->word();
        $exportDataTask->setSort($sort);
    }

    private static function generateNum(ExportDataTask $exportDataTask, array $value, $faker) : void
    {
        $size = isset($value['size']) ? $value['size'] : $faker->randomDigitNotNull();
        $total = isset($value['total']) ? $value['total'] : rand(0, $size);
        $updatedNum = isset($value['updatedNum']) ? $value['updatedNum'] : $total;
        $offset = isset($value['offset']) ? $value['offset'] : $faker->randomDigitNotNull();

        $exportDataTask->setTotal($total);
        $exportDataTask->setSize($size);
        $exportDataTask->setOffset($offset);
        $exportDataTask->setUpdatedNum($updatedNum);
    }

    private static function generateCode(ExportDataTask $exportDataTask, array $value, $faker) : void
    {
        $code = isset($value['code']) ?
            $value['code'] :
            $faker->randomElement(
                ExportDataTask::CODE
            );
        $exportDataTask->setCode($code);
    }

    private static function generateStaffAndOrganization(ExportDataTask $exportDataTask, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $exportDataTask->setStaff($staff);
        $exportDataTask->setOrganization($staff->getOrganization());
    }

    private static function generateDirectoryAndDirectorySnapshot(
        ExportDataTask $exportDataTask,
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

        $exportDataTask->setDirectory($directory);
        $exportDataTask->setDirectorySnapshot($directorySnapshot);
    }

    private static function generateStatus(ExportDataTask $exportDataTask, array $value, $faker) : void
    {
        $status = isset($value['status']) ?
            $value['status'] :
            $faker->randomElement(
                ExportDataTask::TASK_STATUS
            );
        $exportDataTask->setStatus($status);
    }
}
