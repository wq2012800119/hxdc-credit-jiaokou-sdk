<?php
namespace Sdk\Resource\Enterprise\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Model\NullEnterprise;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class EnterpriseRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getDataRestfulTranslator() : DataRestfulTranslator
    {
        return new DataRestfulTranslator();
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function arrayToObject(array $expression, $enterprise = null)
    {
        if (empty($expression)) {
            return NullEnterprise::getInstance();
        }

        if ($enterprise == null) {
            $enterprise = new Enterprise();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $enterprise->setId($data['id']);
        }
        if (isset($attributes['ztmc'])) {
            $enterprise->setZtmc($attributes['ztmc']);
        }
        if (isset($attributes['ztlb'])) {
            $enterprise->setZtlb($attributes['ztlb']);
        }
        if (isset($attributes['tyshxydm'])) {
            $enterprise->setTyshxydm($attributes['tyshxydm']);
        }
        if (isset($attributes['fddbr'])) {
            $enterprise->setFddbr($attributes['fddbr']);
        }
        if (isset($attributes['fddbrzjlx'])) {
            $enterprise->setFddbrzjlx($attributes['fddbrzjlx']);
        }
        if (isset($attributes['fddbrzjhm'])) {
            $enterprise->setFddbrzjhm($attributes['fddbrzjhm']);
        }
        if (isset($attributes['clrq'])) {
            $enterprise->setClrq($attributes['clrq']);
        }
        if (isset($attributes['yxq'])) {
            $enterprise->setYxq($attributes['yxq']);
        }
        if (isset($attributes['dz'])) {
            $enterprise->setDz($attributes['dz']);
        }
        if (isset($attributes['djjg'])) {
            $enterprise->setDjjg($attributes['djjg']);
        }
        if (isset($attributes['gb'])) {
            $enterprise->setGb($attributes['gb']);
        }
        if (isset($attributes['zczb'])) {
            $enterprise->setZczb($attributes['zczb']);
        }
        if (isset($attributes['zczbbz'])) {
            $enterprise->setZczbbz($attributes['zczbbz']);
        }
        if (isset($attributes['hydm'])) {
            $enterprise->setHydm($attributes['hydm']);
        }
        if (isset($attributes['lx'])) {
            $enterprise->setLx($attributes['lx']);
        }
        if (isset($attributes['jyfw'])) {
            $enterprise->setJyfw($attributes['jyfw']);
        }
        if (isset($attributes['jyzt'])) {
            $enterprise->setJyzt($attributes['jyzt']);
        }
        if (isset($attributes['jyfwms'])) {
            $enterprise->setJyfwms($attributes['jyfwms']);
        }
        if (isset($attributes['authorization'])) {
            $enterprise->setAuthorization($attributes['authorization']);
        }
        if (isset($attributes['complaintCount'])) {
            $enterprise->setComplaintCount($attributes['complaintCount']);
        }
        if (isset($attributes['praiseCount'])) {
            $enterprise->setPraiseCount($attributes['praiseCount']);
        }
        if (isset($attributes['status'])) {
            $enterprise->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $enterprise->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $enterprise->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $enterprise->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }
        if (isset($relationships['source'])) {
            $sourceArray = $this->relationshipFill($relationships['source'], $included);
            $source = $this->getDataRestfulTranslator()->arrayToObject($sourceArray);
            $enterprise->setSource($source);
        }
        
        return $enterprise;
    }

    public function objectToArray($enterprise, array $keys = array())
    {
        unset($enterprise);
        unset($keys);

        return [];
    }
}
