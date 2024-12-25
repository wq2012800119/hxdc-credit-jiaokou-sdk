<?php
namespace Sdk\Resource\NaturalPerson\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Model\NullNaturalPerson;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;

class NaturalPersonRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getDataRestfulTranslator() : DataRestfulTranslator
    {
        return new DataRestfulTranslator();
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function arrayToObject(array $expression, $naturalPerson = null)
    {
        if (empty($expression)) {
            return NullNaturalPerson::getInstance();
        }

        if ($naturalPerson == null) {
            $naturalPerson = new NaturalPerson();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $naturalPerson->setId($data['id']);
        }
        if (isset($attributes['ztmc'])) {
            $naturalPerson->setZtmc($attributes['ztmc']);
        }
        if (isset($attributes['cym'])) {
            $naturalPerson->setCym($attributes['cym']);
        }
        if (isset($attributes['zjhm'])) {
            $naturalPerson->setZjhm($attributes['zjhm']);
        }
        if (isset($attributes['xb'])) {
            $naturalPerson->setXb($attributes['xb']);
        }
        if (isset($attributes['csrq'])) {
            $naturalPerson->setCsrq($attributes['csrq']);
        }
        if (isset($attributes['cssj'])) {
            $naturalPerson->setCssj($attributes['cssj']);
        }
        if (isset($attributes['csdgj'])) {
            $naturalPerson->setCsdgj($attributes['csdgj']);
        }
        if (isset($attributes['csdssx'])) {
            $naturalPerson->setCsdssx($attributes['csdssx']);
        }
        if (isset($attributes['jggj'])) {
            $naturalPerson->setJggj($attributes['jggj']);
        }
        if (isset($attributes['jgssx'])) {
            $naturalPerson->setJgssx($attributes['jgssx']);
        }
        if (isset($attributes['swrq'])) {
            $naturalPerson->setSwrq($attributes['swrq']);
        }
        if (isset($attributes['qcrq'])) {
            $naturalPerson->setQcrq($attributes['qcrq']);
        }
        if (isset($attributes['hb'])) {
            $naturalPerson->setHb($attributes['hb']);
        }
        if (isset($attributes['hh'])) {
            $naturalPerson->setHh($attributes['hh']);
        }
        if (isset($attributes['yhzgx'])) {
            $naturalPerson->setYhzgx($attributes['yhzgx']);
        }
        if (isset($attributes['ryzt'])) {
            $naturalPerson->setRyzt($attributes['ryzt']);
        }
        if (isset($attributes['pcs'])) {
            $naturalPerson->setPcs($attributes['pcs']);
        }
        if (isset($attributes['jlx'])) {
            $naturalPerson->setJlx($attributes['jlx']);
        }
        if (isset($attributes['mlph'])) {
            $naturalPerson->setMlph($attributes['mlph']);
        }
        if (isset($attributes['mlxz'])) {
            $naturalPerson->setMlxz($attributes['mlxz']);
        }
        if (isset($attributes['xzjd'])) {
            $naturalPerson->setXzjd($attributes['xzjd']);
        }
        if (isset($attributes['jcwh'])) {
            $naturalPerson->setJcwh($attributes['jcwh']);
        }
        if (isset($attributes['mz'])) {
            $naturalPerson->setMz($attributes['mz']);
        }
        if (isset($attributes['authorization'])) {
            $naturalPerson->setAuthorization($attributes['authorization']);
        }
        if (isset($attributes['status'])) {
            $naturalPerson->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $naturalPerson->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $naturalPerson->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $naturalPerson->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }
        if (isset($relationships['source'])) {
            $sourceArray = $this->relationshipFill($relationships['source'], $included);
            $source = $this->getDataRestfulTranslator()->arrayToObject($sourceArray);
            $naturalPerson->setSource($source);
        }
        
        return $naturalPerson;
    }

    public function objectToArray($naturalPerson, array $keys = array())
    {
        unset($naturalPerson);
        unset($keys);

        return [];
    }
}
