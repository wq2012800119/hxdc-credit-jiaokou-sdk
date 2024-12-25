<?php
namespace Sdk\Resource\NaturalPerson\Utils;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(NaturalPerson $naturalPerson, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $naturalPerson->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['ztmc'])) {
            $this->assertEquals($attributes['ztmc'], $naturalPerson->getZtmc());
        }
        if (isset($attributes['cym'])) {
            $this->assertEquals($attributes['cym'], $naturalPerson->getCym());
        }
        if (isset($attributes['xb'])) {
            $this->assertEquals($attributes['xb'], $naturalPerson->getXb());
        }
        if (isset($attributes['csrq'])) {
            $this->assertEquals($attributes['csrq'], $naturalPerson->getCsrq());
        }
        if (isset($attributes['cssj'])) {
            $this->assertEquals($attributes['cssj'], $naturalPerson->getCssj());
        }
        if (isset($attributes['csdgj'])) {
            $this->assertEquals($attributes['csdgj'], $naturalPerson->getCsdgj());
        }
        if (isset($attributes['csdssx'])) {
            $this->assertEquals($attributes['csdssx'], $naturalPerson->getCsdssx());
        }
        if (isset($attributes['jggj'])) {
            $this->assertEquals($attributes['jggj'], $naturalPerson->getJggj());
        }
        if (isset($attributes['jgssx'])) {
            $this->assertEquals($attributes['jgssx'], $naturalPerson->getJgssx());
        }
        if (isset($attributes['swrq'])) {
            $this->assertEquals($attributes['swrq'], $naturalPerson->getSwrq());
        }
        if (isset($attributes['qcrq'])) {
            $this->assertEquals($attributes['qcrq'], $naturalPerson->getQcrq());
        }
        if (isset($attributes['hb'])) {
            $this->assertEquals($attributes['hb'], $naturalPerson->getHb());
        }
        if (isset($attributes['hh'])) {
            $this->assertEquals($attributes['hh'], $naturalPerson->getHh());
        }
        if (isset($attributes['yhzgx'])) {
            $this->assertEquals($attributes['yhzgx'], $naturalPerson->getYhzgx());
        }
        if (isset($attributes['ryzt'])) {
            $this->assertEquals($attributes['ryzt'], $naturalPerson->getRyzt());
        }
        if (isset($attributes['pcs'])) {
            $this->assertEquals($attributes['pcs'], $naturalPerson->getPcs());
        }
        if (isset($attributes['jlx'])) {
            $this->assertEquals($attributes['jlx'], $naturalPerson->getJlx());
        }
        if (isset($attributes['mlph'])) {
            $this->assertEquals($attributes['mlph'], $naturalPerson->getMlph());
        }
        if (isset($attributes['mlxz'])) {
            $this->assertEquals($attributes['mlxz'], $naturalPerson->getMlxz());
        }
        if (isset($attributes['xzjd'])) {
            $this->assertEquals($attributes['xzjd'], $naturalPerson->getXzjd());
        }
        if (isset($attributes['jcwh'])) {
            $this->assertEquals($attributes['jcwh'], $naturalPerson->getJcwh());
        }
        if (isset($attributes['mz'])) {
            $this->assertEquals($attributes['mz'], $naturalPerson->getMz());
        }
        if (isset($attributes['authorization'])) {
            $this->assertEquals($attributes['authorization'], $naturalPerson->getAuthorization());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $naturalPerson->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $naturalPerson->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $naturalPerson->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $naturalPerson->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ?$expression['data']['relationships'] : array();
        if (isset($relationships['source']['data'])) {
            $source = $relationships['source']['data'];
            $this->assertEquals($source['type'], 'data');
            $this->assertEquals($source['id'], $naturalPerson->getSource()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, NaturalPerson $naturalPerson)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($naturalPerson->getId()));
        }
        if (isset($expression['ztmc'])) {
            $this->assertEquals($expression['ztmc'], $naturalPerson->getZtmc());
        }
        if (isset($expression['cym'])) {
            $this->assertEquals($expression['cym'], $naturalPerson->getCym());
        }
        if (isset($expression['zjhm'])) {
            $this->assertEquals($expression['zjhm'], $naturalPerson->getZjhm());
        }
        if (isset($expression['xb'])) {
            $this->assertEquals($expression['xb'], $naturalPerson->getXb());
        }
        if (isset($expression['csrq'])) {
            $this->assertEquals($expression['csrq'], $naturalPerson->getCsrq());
            $this->assertEquals($expression['csrqFormatConvert'], date('Y-m-d', $naturalPerson->getCsrq()));
        }
        if (isset($expression['cssj'])) {
            $this->assertEquals($expression['cssj'], $naturalPerson->getCssj());
        }
        if (isset($expression['csdgj'])) {
            $this->assertEquals($expression['csdgj'], $naturalPerson->getCsdgj());
        }
        if (isset($expression['jggj'])) {
            $this->assertEquals($expression['jggj'], $naturalPerson->getJggj());
        }
        if (isset($expression['jgssx'])) {
            $this->assertEquals($expression['jgssx'], $naturalPerson->getJgssx());
        }
        if (isset($expression['swrq'])) {
            $this->assertEquals($expression['swrq'], $naturalPerson->getSwrq());
            $this->assertEquals($expression['swrqFormatConvert'], date('Y-m-d', $naturalPerson->getSwrq()));
        }
        if (isset($expression['qcrq'])) {
            $this->assertEquals($expression['qcrq'], $naturalPerson->getQcrq());
            $this->assertEquals($expression['qcrqFormatConvert'], date('Y-m-d', $naturalPerson->getQcrq()));
        }
        if (isset($expression['hb'])) {
            $this->assertEquals($expression['hb'], $naturalPerson->getHb());
        }
        if (isset($expression['hh'])) {
            $this->assertEquals($expression['hh'], $naturalPerson->getHh());
        }
        if (isset($expression['yhzgx'])) {
            $this->assertEquals($expression['yhzgx'], $naturalPerson->getYhzgx());
        }
        if (isset($expression['ryzt'])) {
            $this->assertEquals($expression['ryzt'], $naturalPerson->getRyzt());
        }
        if (isset($expression['pcs'])) {
            $this->assertEquals($expression['pcs'], $naturalPerson->getPcs());
        }
        if (isset($expression['jlx'])) {
            $this->assertEquals($expression['jlx'], $naturalPerson->getJlx());
        }
        if (isset($expression['mlph'])) {
            $this->assertEquals($expression['mlph'], $naturalPerson->getMlph());
        }
        if (isset($expression['mlxz'])) {
            $this->assertEquals($expression['mlxz'], $naturalPerson->getMlxz());
        }
        if (isset($expression['xzjd'])) {
            $this->assertEquals($expression['xzjd'], $naturalPerson->getXzjd());
        }
        if (isset($expression['jcwh'])) {
            $this->assertEquals($expression['jcwh'], $naturalPerson->getJcwh());
        }
        if (isset($expression['mz'])) {
            $this->assertEquals($expression['mz'], $naturalPerson->getMz());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $naturalPerson->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $naturalPerson->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $naturalPerson->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $naturalPerson->getUpdateTime())
            );
        }
    }
}
