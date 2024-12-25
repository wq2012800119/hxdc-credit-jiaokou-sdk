<?php
namespace Sdk\Resource\Enterprise\Utils;

use Sdk\Resource\Enterprise\Model\Enterprise;

use Sdk\Resource\Data\Utils\MockObjectGenerate as DataMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class MockObjectGenerate
{
    public static function generateEnterprise(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Enterprise {

        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $enterprise = new Enterprise($id);
        $enterprise->setId($id);

        //ztmc
        self::generateZtmc($enterprise, $value, $faker);
        //ztlb
        self::generateZtlb($enterprise, $value, $faker);
        //tyshxydm
        self::generateTyshxydm($enterprise, $value, $faker);
        //fddbr,fddbrzjlx,fddbrzjhm
        self::generateFddbr($enterprise, $value, $faker);
        //clrq
        self::generateClrq($enterprise, $value, $faker);
        //yxq
        self::generateYxq($enterprise, $value, $faker);
        //dz
        self::generateDz($enterprise, $value, $faker);
        //djjg
        self::generateDjjg($enterprise, $value, $faker);
        //gb
        self::generateGb($enterprise, $value, $faker);
        //zczb,zczbbz
        self::generateZczb($enterprise, $value, $faker);
        //hydm
        self::generateHydm($enterprise, $value, $faker);
        //lx
        self::generateLx($enterprise, $value, $faker);
        //jyfw,jyzt,jyfwms
        self::generateJyfw($enterprise, $value, $faker);
        //authorization
        self::generateAuthorization($enterprise, $value, $faker);
        //source
        self::generateSource($enterprise, $value, $faker);
        
        $enterprise->setStatus($faker->randomDigitNotNull());
        $enterprise->setCreateTime($faker->unixTime());
        $enterprise->setUpdateTime($faker->unixTime());
        $enterprise->setStatusTime($faker->unixTime());
        return $enterprise;
    }

    private static function generateZtmc(Enterprise $enterprise, array $value, $faker) :void
    {
        $ztmc = isset($value['ztmc']) ? $value['ztmc'] : $faker->name();
        $enterprise->setZtmc($ztmc);
    }

    private static function generateZtlb(Enterprise $enterprise, array $value, $faker) : void
    {
        $ztlb = isset($value['ztlb']) ? $value['ztlb'] : $faker->randomElement(Enterprise::ZTLB);
        $enterprise->setZtlb($ztlb);
    }

    private static function generateTyshxydm(Enterprise $enterprise, array $value, $faker) :void
    {
        //tyshxydm
        $tyshxydm = isset($value['tyshxydm']) ? $value['tyshxydm'] : $faker->bothify('##################');
        $enterprise->setTyshxydm($tyshxydm);
    }

    private static function generateFddbr(Enterprise $enterprise, array $value, $faker) :void
    {
        //fddbr
        $fddbr = isset($value['fddbr']) ? $value['fddbr'] : $faker->name();
        $fddbrzjhm = isset($value['fddbr']) ? $value['fddbr'] : $faker->bothify('##################');
        $enterprise->setFddbr($fddbr);
        $enterprise->setFddbrzjlx('身份证');
        $enterprise->setFddbrzjhm($fddbrzjhm);
    }

    private static function generateClrq(Enterprise $enterprise, array $value, $faker) :void
    {
        //clrq
        $clrq = isset($value['clrq']) ? $value['clrq'] : $faker->unixTime();
        $enterprise->setClrq($clrq);
    }

    private static function generateYxq(Enterprise $enterprise, array $value, $faker) :void
    {
        //yxq
        $yxq = isset($value['yxq']) ? $value['yxq'] : $faker->date('Y-m-d', 'now');
        $enterprise->setYxq($yxq);
    }

    private static function generateDz(Enterprise $enterprise, array $value, $faker) :void
    {
        //dz
        $dz = isset($value['dz']) ? $value['dz'] : $faker->address();
        $enterprise->setDz($dz);
    }

    private static function generateDjjg(Enterprise $enterprise, array $value, $faker) :void
    {
        //djjg
        $djjg = isset($value['djjg']) ? $value['djjg'] : $faker->word();
        $enterprise->setDjjg($djjg);
    }

    private static function generateGb(Enterprise $enterprise, array $value, $faker) :void
    {
        //gb
        $gb = isset($value['gb']) ? $value['gb'] : $faker->country();
        $enterprise->setGb($gb);
    }

    private static function generateZczb(Enterprise $enterprise, array $value, $faker) :void
    {
        //zczb
        $zczb = isset($value['zczb']) ? $value['zczb'] : $faker->randomDigitNotNull();
        $enterprise->setZczb($zczb);
        $enterprise->setZczbbz('人民币');
    }

    private static function generateHydm(Enterprise $enterprise, array $value, $faker) :void
    {
        //hydm
        $hydm = isset($value['hydm']) ? $value['hydm'] : $faker->randomElement(Enterprise::HYDM);
        $enterprise->setHydm($hydm);
    }

    private static function generateLx(Enterprise $enterprise, array $value, $faker) :void
    {
        //lx
        $lx = isset($value['lx']) ? $value['lx'] : $faker->word();
        $enterprise->setLx($lx);
    }

    private static function generateJyfw(Enterprise $enterprise, array $value, $faker) :void
    {
        //jyfw
        $jyfw = isset($value['jyfw']) ? $value['jyfw'] : $faker->title();
        $jyzt = isset($value['jyzt']) ? $value['jyzt'] : $faker->randomElement(Enterprise::JYZT);
        $jyfwms = isset($value['jyfwms']) ? $value['jyfwms'] : $faker->text();
        $enterprise->setJyfw($jyfw);
        $enterprise->setJyzt($jyzt);
        $enterprise->setJyfwms($jyfwms);
    }

    private static function generateAuthorization(Enterprise $enterprise, array $value, $faker) : void
    {
        $authorization = isset($value['authorization']) ?
            $value['authorization'] :
            $faker->randomElement(
                Enterprise::AUTHORIZATION
            );
        $enterprise->setAuthorization($authorization);
    }

    private static function generateSource(Enterprise $enterprise, array $value, $faker) :void
    {
        //source
        $source = isset($value['source']) ?
                        $value['source'] :
                        DataMockObjectGenerate::generateData($faker->randomDigitNotNull());

        $enterprise->setSource($source);
    }
}
