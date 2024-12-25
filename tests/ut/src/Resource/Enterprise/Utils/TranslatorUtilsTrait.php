<?php
namespace Sdk\Resource\Enterprise\Utils;

use Sdk\Resource\Enterprise\Model\Enterprise;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Enterprise $enterprise, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $enterprise->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['ztmc'])) {
            $this->assertEquals($attributes['ztmc'], $enterprise->getZtmc());
        }
        if (isset($attributes['ztlb'])) {
            $this->assertEquals($attributes['ztlb'], $enterprise->getZtlb());
        }
        if (isset($attributes['tyshxydm'])) {
            $this->assertEquals($attributes['tyshxydm'], $enterprise->getTyshxydm());
        }
        if (isset($attributes['fddbr'])) {
            $this->assertEquals($attributes['fddbr'], $enterprise->getFddbr());
        }
        if (isset($attributes['fddbrzjlx'])) {
            $this->assertEquals($attributes['fddbrzjlx'], $enterprise->getFddbrzjlx());
        }
        if (isset($attributes['fddbrzjhm'])) {
            $this->assertEquals($attributes['fddbrzjhm'], $enterprise->getFddbrzjhm());
        }
        if (isset($attributes['clrq'])) {
            $this->assertEquals($attributes['clrq'], $enterprise->getClrq());
        }
        if (isset($attributes['yxq'])) {
            $this->assertEquals($attributes['yxq'], $enterprise->getYxq());
        }
        if (isset($attributes['dz'])) {
            $this->assertEquals($attributes['dz'], $enterprise->getDz());
        }
        if (isset($attributes['djjg'])) {
            $this->assertEquals($attributes['djjg'], $enterprise->getDjjg());
        }
        if (isset($attributes['gb'])) {
            $this->assertEquals($attributes['gb'], $enterprise->getGb());
        }
        if (isset($attributes['zczb'])) {
            $this->assertEquals($attributes['zczb'], $enterprise->getZczb());
        }
        if (isset($attributes['zczbbz'])) {
            $this->assertEquals($attributes['zczbbz'], $enterprise->getZczbbz());
        }
        if (isset($attributes['hydm'])) {
            $this->assertEquals($attributes['hydm'], $enterprise->getHydm());
        }
        if (isset($attributes['lx'])) {
            $this->assertEquals($attributes['lx'], $enterprise->getLx());
        }
        if (isset($attributes['jyfw'])) {
            $this->assertEquals($attributes['jyfw'], $enterprise->getJyfw());
        }
        if (isset($attributes['jyzt'])) {
            $this->assertEquals($attributes['jyzt'], $enterprise->getJyzt());
        }
        if (isset($attributes['jyfwms'])) {
            $this->assertEquals($attributes['jyfwms'], $enterprise->getJyfwms());
        }
        if (isset($attributes['authorization'])) {
            $this->assertEquals($attributes['authorization'], $enterprise->getAuthorization());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $enterprise->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $enterprise->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $enterprise->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $enterprise->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ?$expression['data']['relationships'] : array();
        if (isset($relationships['source']['data'])) {
            $source = $relationships['source']['data'];
            $this->assertEquals($source['type'], 'data');
            $this->assertEquals($source['id'], $enterprise->getSource()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Enterprise $enterprise)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($enterprise->getId()));
        }
        if (isset($expression['ztmc'])) {
            $this->assertEquals($expression['ztmc'], $enterprise->getZtmc());
        }
        if (isset($expression['tyshxydm'])) {
            $this->assertEquals($expression['tyshxydm'], $enterprise->getTyshxydm());
        }
        if (isset($expression['fddbr'])) {
            $this->assertEquals($expression['fddbr'], $enterprise->getFddbr());
        }
        if (isset($expression['fddbrzjlx'])) {
            $this->assertEquals($expression['fddbrzjlx'], $enterprise->getFddbrzjlx());
        }
        if (isset($expression['fddbrzjhm'])) {
            $this->assertEquals($expression['fddbrzjhm'], $enterprise->getFddbrzjhm());
        }
        if (isset($expression['clrq'])) {
            $this->assertEquals($expression['clrq'], $enterprise->getClrq());
            $this->assertEquals(
                $expression['clrqFormatConvert'],
                date('Y-m-d', $enterprise->getClrq())
            );
        }
        if (isset($expression['yxq'])) {
            $this->assertEquals($expression['yxq'], $enterprise->getYxq());
        }
        if (isset($expression['dz'])) {
            $this->assertEquals($expression['dz'], $enterprise->getDz());
        }
        if (isset($expression['djjg'])) {
            $this->assertEquals($expression['djjg'], $enterprise->getDjjg());
        }
        if (isset($expression['gb'])) {
            $this->assertEquals($expression['gb'], $enterprise->getGb());
        }
        if (isset($expression['zczb'])) {
            $this->assertEquals($expression['zczb'], $enterprise->getZczb());
        }
        if (isset($expression['zczbbz'])) {
            $this->assertEquals($expression['zczbbz'], $enterprise->getZczbbz());
        }
        if (isset($expression['lx'])) {
            $this->assertEquals($expression['lx'], $enterprise->getLx());
        }
        if (isset($expression['jyfw'])) {
            $this->assertEquals($expression['jyfw'], $enterprise->getJyfw());
        }
        if (isset($expression['jyfwms'])) {
            $this->assertEquals($expression['jyfwms'], $enterprise->getJyfwms());
        }
        if (isset($expression['hydm'])) {
            $hydm = $enterprise->getHydm();
            $this->assertEquals($expression['hydm'], array(
                'id' => $hydm,
                'name' => isset(Enterprise::HYDM_CN[$hydm]) ? Enterprise::HYDM_CN[$hydm] : ''
            ));
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $enterprise->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $enterprise->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $enterprise->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $enterprise->getUpdateTime())
            );
        }
    }
}
