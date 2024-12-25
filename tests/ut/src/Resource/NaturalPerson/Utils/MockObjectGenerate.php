<?php
namespace Sdk\Resource\NaturalPerson\Utils;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;

use Sdk\Resource\Data\Utils\MockObjectGenerate as DataMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class MockObjectGenerate
{
    public static function generateNaturalPerson(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : NaturalPerson {

        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $naturalPerson = new NaturalPerson($id);
        $naturalPerson->setId($id);

        //ztmc
        self::generateZtmc($naturalPerson, $value, $faker);
        //cym
        self::generateCym($naturalPerson, $value, $faker);
        //zjhm
        self::generateZjhm($naturalPerson, $value, $faker);
        //xb
        self::generateXb($naturalPerson, $value, $faker);
        //csrq,cssj,csdgj,csdssx
        self::generateCsInfo($naturalPerson, $value, $faker);
        //jggj,jgssx
        self::generateJgInfo($naturalPerson, $value, $faker);
        //swrq
        self::generateSwrq($naturalPerson, $value, $faker);
        //qcrq
        self::generateQcrq($naturalPerson, $value, $faker);
        //hb,hh,yhzgx
        self::generateHzInfo($naturalPerson, $value, $faker);
        //ryzt
        self::generateRyzt($naturalPerson, $value, $faker);
        //pcs
        self::generatePcs($naturalPerson, $value, $faker);
        //jlx,mlph,mlxz,xzjd,jcwh
        self::generateMpInfo($naturalPerson, $value, $faker);
        //mz
        self::generateMz($naturalPerson, $value, $faker);
        //authorization
        self::generateAuthorization($naturalPerson, $value, $faker);
        //source
        self::generateSource($naturalPerson, $value, $faker);
        
        $naturalPerson->setStatus($faker->randomDigitNotNull());
        $naturalPerson->setCreateTime($faker->unixTime());
        $naturalPerson->setUpdateTime($faker->unixTime());
        $naturalPerson->setStatusTime($faker->unixTime());
        return $naturalPerson;
    }

    private static function generateZtmc(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        $ztmc = isset($value['ztmc']) ? $value['ztmc'] : $faker->name();
        $naturalPerson->setZtmc($ztmc);
    }

    private static function generateCym(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        $cym = isset($value['cym']) ? $value['cym'] : $faker->name();
        $naturalPerson->setCym($cym);
    }

    private static function generateZjhm(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //zjhm
        $zjhm = isset($value['zjhm']) ? $value['zjhm'] : $faker->bothify('##################');
        $naturalPerson->setZjhm($zjhm);
    }

    private static function generateXb(NaturalPerson $naturalPerson, array $value, $faker) : void
    {
        $xb = isset($value['xb']) ? $value['xb'] : $faker->randomElement(array ('男','女'));
        $naturalPerson->setXb($xb);
    }

    private static function generateCsInfo(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //csrq
        $csrq = isset($value['csrq']) ? $value['csrq'] : $faker->unixTime();
        //cssj
        $cssj = isset($value['cssj']) ? $value['cssj'] : $faker->time('H:i:s', 'now');
        //csdgj
        $csdgj = isset($value['csdgj']) ? $value['csdgj'] : $faker->country();
        //csdssx
        $csdssx = isset($value['csdssx']) ? $value['csdssx'] : $faker->city();

        $naturalPerson->setCsrq($csrq);
        $naturalPerson->setCssj($cssj);
        $naturalPerson->setCsdgj($csdgj);
        $naturalPerson->setCsdssx($csdssx);
    }

    private static function generateJgInfo(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //jggj
        $jggj = isset($value['jggj']) ? $value['jggj'] : $faker->country();
        //jgssx
        $jgssx = isset($value['jgssx']) ? $value['jgssx'] : $faker->city();

        $naturalPerson->setJggj($jggj);
        $naturalPerson->setJgssx($jgssx);
    }
    
    private static function generateSwrq(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //swrq
        $swrq = isset($value['swrq']) ? $value['swrq'] : $faker->unixTime();
        $naturalPerson->setSwrq($swrq);
    }
    
    private static function generateQcrq(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //qcrq
        $qcrq = isset($value['qcrq']) ? $value['qcrq'] : $faker->unixTime();
        $naturalPerson->setQcrq($qcrq);
    }
    
    private static function generateHzInfo(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //hb
        $hb = isset($value['hb']) ? $value['hb'] : $faker->word();
        //hh
        $hh = isset($value['hh']) ? $value['hh'] : $faker->word();
        //yhzgx
        $yhzgx = isset($value['yhzgx']) ? $value['yhzgx'] : $faker->word();

        $naturalPerson->setJggj($hb);
        $naturalPerson->setJgssx($hh);
        $naturalPerson->setJgssx($yhzgx);
    }

    private static function generateRyzt(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //ryzt
        $ryzt = isset($value['ryzt']) ? $value['ryzt'] : $faker->word();
        $naturalPerson->setRyzt($ryzt);
    }
    
    private static function generatePcs(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //pcs
        $pcs = isset($value['pcs']) ? $value['pcs'] : $faker->word();
        $naturalPerson->setPcs($pcs);
    }

    private static function generateMpInfo(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //jlx
        $jlx = isset($value['jlx']) ? $value['jlx'] : $faker->word();
        //mlph
        $mlph = isset($value['mlph']) ? $value['mlph'] : $faker->word();
        //mlxz
        $mlxz = isset($value['mlxz']) ? $value['mlxz'] : $faker->word();
        //xzjd
        $xzjd = isset($value['xzjd']) ? $value['xzjd'] : $faker->word();
        //jcwh
        $jcwh = isset($value['jcwh']) ? $value['jcwh'] : $faker->word();

        $naturalPerson->setJlx($jlx);
        $naturalPerson->setMlph($mlph);
        $naturalPerson->setMlxz($mlxz);
        $naturalPerson->setXzjd($xzjd);
        $naturalPerson->setJcwh($jcwh);
    }

    private static function generateMz(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //mz
        $mz = isset($value['mz']) ? $value['mz'] : $faker->word();
        $naturalPerson->setMz($mz);
    }

    private static function generateAuthorization(NaturalPerson $naturalPerson, array $value, $faker) : void
    {
        $authorization = isset($value['authorization']) ?
            $value['authorization'] :
            $faker->randomElement(
                NaturalPerson::AUTHORIZATION
            );
        $naturalPerson->setAuthorization($authorization);
    }

    private static function generateSource(NaturalPerson $naturalPerson, array $value, $faker) :void
    {
        //source
        $source = isset($value['source']) ?
                        $value['source'] :
                        DataMockObjectGenerate::generateData($faker->randomDigitNotNull());

        $naturalPerson->setSource($source);
    }
}
