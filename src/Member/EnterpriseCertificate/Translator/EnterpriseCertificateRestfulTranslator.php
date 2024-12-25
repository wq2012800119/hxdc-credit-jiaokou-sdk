<?php
namespace Sdk\Member\EnterpriseCertificate\Translator;

use Sdk\Member\EnterpriseCertificate\Model\EnterpriseCertificate;
use Sdk\Member\EnterpriseCertificate\Model\NullEnterpriseCertificate;
use Sdk\Resource\Enterprise\Translator\EnterpriseRestfulTranslator;
use Sdk\User\Member\Translator\MemberRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class EnterpriseCertificateRestfulTranslator extends EnterpriseRestfulTranslator
{

    protected function getMemberRestfulTranslator() : MemberRestfulTranslator
    {
        return new MemberRestfulTranslator();
    }

    public function arrayToObject(array $expression, $enterpriseCertificate = null)
    {
        if (empty($expression)) {
            return NullEnterpriseCertificate::getInstance();
        }

        if ($enterpriseCertificate == null) {
            $enterpriseCertificate = new EnterpriseCertificate();
        }
       
        $enterpriseCertificate = parent::arrayToObject($expression, $enterpriseCertificate);

        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($attributes['businessLicensePicture'])) {
            $enterpriseCertificate->setBusinessLicensePicture($attributes['businessLicensePicture']);
        }
        if (isset($attributes['rejectReason'])) {
            $enterpriseCertificate->setRejectReason($attributes['rejectReason']);
        }
        if (isset($attributes['examineStatus'])) {
            $enterpriseCertificate->setExamineStatus($attributes['examineStatus']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['member'])) {
            $memberArray = $this->relationshipFill($relationships['member'], $included);
            $member = $this->getMemberRestfulTranslator()->arrayToObject($memberArray);
            $enterpriseCertificate->setMember($member);
        }
        
        return $enterpriseCertificate;
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function objectToArray($enterpriseCertificate, array $keys = array())
    {
        if (!$enterpriseCertificate instanceof EnterpriseCertificate) {
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
                'businessLicensePicture',
                'rejectReason',
                'member'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'enterpriseCertificates'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $enterpriseCertificate->getId();
        }

        $attributes = array();

        if (in_array('ztmc', $keys)) {
            $attributes['ztmc'] = $enterpriseCertificate->getZtmc();
        }
        if (in_array('ztlb', $keys)) {
            $attributes['ztlb'] = $enterpriseCertificate->getZtlb();
        }
        if (in_array('tyshxydm', $keys)) {
            $attributes['tyshxydm'] = $enterpriseCertificate->getTyshxydm();
        }
        if (in_array('fddbr', $keys)) {
            $attributes['fddbr'] = $enterpriseCertificate->getFddbr();
        }
        if (in_array('fddbrzjlx', $keys)) {
            $attributes['fddbrzjlx'] = $enterpriseCertificate->getFddbrzjlx();
        }
        if (in_array('fddbrzjhm', $keys)) {
            $attributes['fddbrzjhm'] = $enterpriseCertificate->getFddbrzjhm();
        }
        if (in_array('clrq', $keys)) {
            $attributes['clrq'] = $enterpriseCertificate->getClrq();
        }
        if (in_array('yxq', $keys)) {
            $attributes['yxq'] = $enterpriseCertificate->getYxq();
        }
        if (in_array('dz', $keys)) {
            $attributes['dz'] = $enterpriseCertificate->getDz();
        }
        if (in_array('djjg', $keys)) {
            $attributes['djjg'] = $enterpriseCertificate->getDjjg();
        }
        if (in_array('gb', $keys)) {
            $attributes['gb'] = $enterpriseCertificate->getGb();
        }
        if (in_array('zczb', $keys)) {
            $attributes['zczb'] = $enterpriseCertificate->getZczb();
        }
        if (in_array('zczbbz', $keys)) {
            $attributes['zczbbz'] = $enterpriseCertificate->getZczbbz();
        }
        if (in_array('hydm', $keys)) {
            $attributes['hydm'] = $enterpriseCertificate->getHydm();
        }
        if (in_array('lx', $keys)) {
            $attributes['lx'] = $enterpriseCertificate->getLx();
        }
        if (in_array('jyfw', $keys)) {
            $attributes['jyfw'] = $enterpriseCertificate->getJyfw();
        }
        if (in_array('jyzt', $keys)) {
            $attributes['jyzt'] = $enterpriseCertificate->getJyzt();
        }
        if (in_array('jyfwms', $keys)) {
            $attributes['jyfwms'] = $enterpriseCertificate->getJyfwms();
        }
        if (in_array('businessLicensePicture', $keys)) {
            $attributes['businessLicensePicture'] = $enterpriseCertificate->getBusinessLicensePicture();
        }
        if (in_array('rejectReason', $keys)) {
            $attributes['rejectReason'] = $enterpriseCertificate->getRejectReason();
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('member', $keys)) {
            $expression['data']['relationships']['member']['data'] = array(
                'type' => 'members',
                'id' => strval($enterpriseCertificate->getMember()->getId())
            );
        }
        
        return $expression;
    }
}
