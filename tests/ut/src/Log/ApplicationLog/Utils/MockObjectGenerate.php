<?php
namespace Sdk\Log\ApplicationLog\Utils;

use Sdk\Log\ApplicationLog\Model\ApplicationLog;

class MockObjectGenerate
{
    public static function generateApplicationLog(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : ApplicationLog {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $log = new ApplicationLog($id);
        $log->setId($id);

        //operatorId
        self::generateOperatorId($log, $value, $faker);
        //operatorIdentify
        self::generateOperatorIdentify($log, $value, $faker);
        //operatorCategory
        self::generateOperatorCategory($log, $value, $faker);
        //targetCategory
        self::generateTargetCategory($log, $value, $faker);
        //targetAction
        self::generateTargetAction($log, $value, $faker);
        //targetId
        self::generateTargetId($log, $value, $faker);
        //targetName
        self::generateTargetName($log, $value, $faker);
        //description
        self::generateDescription($log, $value, $faker);
        //errorId
        self::generateErrorId($log, $value, $faker);

        $log->setStatus(0);
        $log->setCreateTime($faker->unixTime());
        $log->setUpdateTime($faker->unixTime());
        $log->setStatusTime($faker->unixTime());

        return $log;
    }

    private static function generateOperatorId(ApplicationLog $log, array $value, $faker) :void
    {
        //operatorId
        $operatorId = isset($value['operatorId']) ? $value['operatorId'] : $faker->randomDigitNotNull();

        $log->setOperatorId($operatorId);
    }

    private static function generateOperatorIdentify(ApplicationLog $log, array $value, $faker) :void
    {
        //operatorIdentify
        $operatorIdentify = isset($value['operatorIdentify']) ? $value['operatorIdentify'] : $faker->phoneNumber();

        $log->setOperatorIdentify($operatorIdentify);
    }

    private static function generateOperatorCategory(ApplicationLog $log, array $value, $faker) : void
    {
        $operatorCategory = isset($value['operatorCategory']) ?
            $value['operatorCategory'] :
            $faker->randomElement(
                ApplicationLog::OPERATOR_CATEGORY
            );
        $log->setOperatorCategory($operatorCategory);
    }

    private static function generateTargetCategory(ApplicationLog $log, array $value, $faker) : void
    {
        $targetCategory = isset($value['targetCategory']) ?
            $value['targetCategory'] :
            $faker->randomElement(
                ApplicationLog::OPERATOR_CATEGORY
            );
        $log->setTargetCategory($targetCategory);
    }

    private static function generateTargetAction(ApplicationLog $log, array $value, $faker) : void
    {
        $targetAction = isset($value['targetAction']) ?
            $value['targetAction'] :
            $faker->randomElement(
                ApplicationLog::OPERATOR_CATEGORY
            );
        $log->setTargetAction($targetAction);
    }

    private static function generateTargetId(ApplicationLog $log, array $value, $faker) :void
    {
        //targetId
        $targetId = isset($value['targetId']) ? $value['targetId'] : $faker->randomDigitNotNull();

        $log->setTargetId($targetId);
    }

    private static function generateTargetName(ApplicationLog $log, array $value, $faker) :void
    {
        //targetName
        $targetName = isset($value['targetName']) ? $value['targetName'] : $faker->title();

        $log->setTargetName($targetName);
    }

    private static function generateDescription(ApplicationLog $log, array $value, $faker) :void
    {
        //description
        $description = isset($value['description']) ? $value['description'] : $faker->title();

        $log->setDescription($description);
    }

    private static function generateErrorId(ApplicationLog $log, array $value, $faker) :void
    {
        //errorId
        $errorId = isset($value['errorId']) ? $value['errorId'] : $faker->randomDigitNotNull();

        $log->setErrorId($errorId);
    }
}
