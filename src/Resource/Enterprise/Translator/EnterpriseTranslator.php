<?php
namespace Sdk\Resource\Enterprise\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Utils\Traits\DesensitizationTrait;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Model\NullEnterprise;

use Sdk\Resource\Data\Translator\DataTranslator;

class EnterpriseTranslator implements ITranslator
{
    use TranslatorTrait, DesensitizationTrait;

    protected function getDataTranslator() : DataTranslator
    {
        return new DataTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullEnterprise::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function objectToArray($enterprise, array $keys = array())
    {
        if (!$enterprise instanceof Enterprise) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'ztmc',
                'ztlb',
                'tyshxydm',
                'fddbr',
                'fddbrzjlx',
                'fddbrzjhm',
                'clrq',
                'yxq',
                'dz',
                'djjg',
                'gb',
                'zczb',
                'zczbbz',
                'hydm',
                'lx',
                'jyfw',
                'jyzt',
                'jyfwms',
                'authorization',
                'complaintCount',
                'praiseCount',
                'source' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($enterprise->getId());
        }
        if (in_array('ztmc', $keys)) {
            $expression['ztmc'] = $enterprise->getZtmc();
        }
        if (in_array('tyshxydm', $keys)) {
            $expression['tyshxydm'] = $enterprise->getTyshxydm();
        }
        if (in_array('fddbr', $keys)) {
            $expression['fddbr'] = $enterprise->getFddbr();
        }
        if (in_array('fddbrzjhm', $keys)) {
            $expression['fddbrzjhm'] = $enterprise->getFddbrzjhm();
            $expression['fddbrzjhmDesensitization'] = $this->idCardDataDesensitization($enterprise->getFddbrzjhm());
        }
        if (in_array('clrq', $keys)) {
            $expression['clrq'] = $enterprise->getClrq();
            $expression['clrqFormatConvert'] = date('Y-m-d', $enterprise->getClrq());
        }
        if (in_array('yxq', $keys)) {
            $expression['yxq'] = $enterprise->getYxq();
            $expression['yxqFormatConvert'] = date('Y-m-d', $enterprise->getYxq());
        }
        if (in_array('dz', $keys)) {
            $expression['dz'] = $enterprise->getDz();
        }
        if (in_array('djjg', $keys)) {
            $expression['djjg'] = $enterprise->getDjjg();
        }
        if (in_array('gb', $keys)) {
            $expression['gb'] = $enterprise->getGb();
        }
        if (in_array('zczb', $keys)) {
            $expression['zczb'] = $enterprise->getZczb();
        }
        if (in_array('zczbbz', $keys)) {
            $expression['zczbbz'] = $enterprise->getZczbbz();
        }
        if (in_array('jyfw', $keys)) {
            $expression['jyfw'] = $enterprise->getJyfw();
        }
        if (in_array('jyfwms', $keys)) {
            $expression['jyfwms'] = $enterprise->getJyfwms();
        }
        if (in_array('complaintCount', $keys)) {
            $expression['complaintCount'] = $enterprise->getComplaintCount();
        }
        if (in_array('praiseCount', $keys)) {
            $expression['praiseCount'] = $enterprise->getPraiseCount();
        }

        $expression = $this->typeObjectToArray($enterprise, $keys, $expression);
        $expression = $this->relationObjectToArray($enterprise, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $enterprise->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $enterprise->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $enterprise->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $enterprise->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Enterprise $enterprise, array $keys, array $expression) : array
    {
        if (in_array('ztlb', $keys)) {
            $expression['ztlb'] = $this->typeFormatConversion($enterprise->getZtlb(), Enterprise::ZTLB_CN);
        }
        if (in_array('hydm', $keys)) {
            $hydm = $enterprise->getHydm();
            $expression['hydm'] = array(
                'id' => $hydm,
                'name' => isset(Enterprise::HYDM_CN[$hydm]) ? Enterprise::HYDM_CN[$hydm] : ''
            );
        }
        if (in_array('fddbrzjlx', $keys)) {
            $fddbrzjlx = $enterprise->getFddbrzjlx();
            $expression['fddbrzjlx'] = array(
                'id' => $fddbrzjlx,
                'name' => isset(Enterprise::FDDBRZJLX_CN[$fddbrzjlx]) ? Enterprise::FDDBRZJLX_CN[$fddbrzjlx] : ''
            );
        }
        if (in_array('lx', $keys)) {
            $enterpriseLx = $enterprise->getLx();
            $expression['lx'] = array(
                'id' => $enterpriseLx,
                'name' => isset(Enterprise::LX_CN[$enterpriseLx]) ? Enterprise::LX_CN[$enterpriseLx] : ''
            );
        }
        if (in_array('jyzt', $keys)) {
            $expression['jyzt'] = $this->typeFormatConversion($enterprise->getJyzt(), Enterprise::JYZT_CN);
        }
        if (in_array('authorization', $keys)) {
            $expression['authorization'] = $this->statusFormatConversion(
                $enterprise->getAuthorization(),
                Enterprise::AUTHORIZATION_TYPE,
                Enterprise::AUTHORIZATION_CN
            );
        }
        return $expression;
    }

    protected function relationObjectToArray(Enterprise $enterprise, array $keys, array $expression) : array
    {
        if (isset($keys['source'])) {
            $expression['source'] = $this->getDataTranslator()->objectToArray(
                $enterprise->getSource(),
                $keys['source']
            );
        }
        
        return $expression;
    }
}
