<?php
namespace Sdk\Resource\NaturalPerson\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Utils\Traits\DesensitizationTrait;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Model\NullNaturalPerson;

use Sdk\Resource\Data\Translator\DataTranslator;

class NaturalPersonTranslator implements ITranslator
{
    use TranslatorTrait, DesensitizationTrait;

    protected function getDataTranslator() : DataTranslator
    {
        return new DataTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullNaturalPerson::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function objectToArray($naturalPerson, array $keys = array())
    {
        if (!$naturalPerson instanceof NaturalPerson) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'ztmc',
                'cym',
                'zjhm',
                'xb',
                'csrq',
                'cssj',
                'csdgj',
                'csdssx',
                'jggj',
                'jgssx',
                'swrq',
                'qcrq',
                'hb',
                'hh',
                'yhzgx',
                'ryzt',
                'pcs',
                'jlx',
                'mlph',
                'mlxz',
                'xzjd',
                'jcwh',
                'mz',
                'authorization',
                'source' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($naturalPerson->getId());
        }
        if (in_array('ztmc', $keys)) {
            $expression['ztmc'] = $naturalPerson->getZtmc();
        }
        if (in_array('cym', $keys)) {
            $expression['cym'] = $naturalPerson->getCym();
        }
        if (in_array('zjhm', $keys)) {
            $expression['zjhm'] = $naturalPerson->getZjhm();
            $expression['zjhmDesensitization'] = $this->idCardDataDesensitization($naturalPerson->getZjhm());
        }
        if (in_array('xb', $keys)) {
            $expression['xb'] = $naturalPerson->getXb();
        }
        if (in_array('csrq', $keys)) {
            $csrq = $naturalPerson->getCsrq();
            $expression['csrq'] = $csrq;
            $expression['csrqFormatConvert'] = !empty($csrq) ? date('Y-m-d', $csrq) : '';
        }
        if (in_array('cssj', $keys)) {
            $expression['cssj'] = $naturalPerson->getCssj();
        }
        if (in_array('csdgj', $keys)) {
            $expression['csdgj'] = $naturalPerson->getCsdgj();
        }
        if (in_array('csdssx', $keys)) {
            $expression['csdssx'] = $naturalPerson->getCsdssx();
        }
        if (in_array('jggj', $keys)) {
            $expression['jggj'] = $naturalPerson->getJggj();
        }
        if (in_array('jgssx', $keys)) {
            $expression['jgssx'] = $naturalPerson->getJgssx();
        }
        if (in_array('swrq', $keys)) {
            $swrq = $naturalPerson->getSwrq();
            $expression['swrq'] = $swrq;
            $expression['swrqFormatConvert'] = !empty($swrq) ? date('Y-m-d', $swrq) : '';
        }
        if (in_array('qcrq', $keys)) {
            $qcrq = $naturalPerson->getQcrq();
            $expression['qcrq'] = $qcrq;
            $expression['qcrqFormatConvert'] = !empty($qcrq) ? date('Y-m-d', $qcrq) : '';
        }
        if (in_array('hb', $keys)) {
            $expression['hb'] = $naturalPerson->getHb();
        }
        if (in_array('hh', $keys)) {
            $expression['hh'] = $naturalPerson->getHh();
        }
        if (in_array('yhzgx', $keys)) {
            $expression['yhzgx'] = $naturalPerson->getYhzgx();
        }
        if (in_array('ryzt', $keys)) {
            $expression['ryzt'] = $naturalPerson->getRyzt();
        }
        if (in_array('pcs', $keys)) {
            $expression['pcs'] = $naturalPerson->getPcs();
        }
        if (in_array('jlx', $keys)) {
            $expression['jlx'] = $naturalPerson->getJlx();
        }
        if (in_array('mlph', $keys)) {
            $expression['mlph'] = $naturalPerson->getMlph();
        }
        if (in_array('mlxz', $keys)) {
            $expression['mlxz'] = $naturalPerson->getMlxz();
        }
        if (in_array('xzjd', $keys)) {
            $expression['xzjd'] = $naturalPerson->getXzjd();
        }
        if (in_array('jcwh', $keys)) {
            $expression['jcwh'] = $naturalPerson->getJcwh();
        }
        if (in_array('mz', $keys)) {
            $expression['mz'] = $naturalPerson->getMz();
        }

        $expression = $this->typeObjectToArray($naturalPerson, $keys, $expression);
        $expression = $this->relationObjectToArray($naturalPerson, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $naturalPerson->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $naturalPerson->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $naturalPerson->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $naturalPerson->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(NaturalPerson $naturalPerson, array $keys, array $expression) : array
    {
        if (in_array('authorization', $keys)) {
            $expression['authorization'] = $this->statusFormatConversion(
                $naturalPerson->getAuthorization(),
                NaturalPerson::AUTHORIZATION_TYPE,
                NaturalPerson::AUTHORIZATION_CN
            );
        }
        return $expression;
    }

    protected function relationObjectToArray(NaturalPerson $naturalPerson, array $keys, array $expression) : array
    {
        if (isset($keys['source'])) {
            $expression['source'] = $this->getDataTranslator()->objectToArray(
                $naturalPerson->getSource(),
                $keys['source']
            );
        }
        
        return $expression;
    }
}
