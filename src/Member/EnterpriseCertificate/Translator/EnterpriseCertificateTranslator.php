<?php
namespace Sdk\Member\EnterpriseCertificate\Translator;

use Marmot\Interfaces\INull;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Utils\Traits\DesensitizationTrait;

use Sdk\Member\EnterpriseCertificate\Model\EnterpriseCertificate;
use Sdk\Member\EnterpriseCertificate\Model\NullEnterpriseCertificate;

use Sdk\Resource\Enterprise\Translator\EnterpriseTranslator;

use Sdk\User\Member\Translator\MemberTranslator;

class EnterpriseCertificateTranslator extends EnterpriseTranslator
{
    use DesensitizationTrait;

    protected function getMemberTranslator() : MemberTranslator
    {
        return new MemberTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullEnterpriseCertificate::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
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
                'member' => ['id', 'subjectName'],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = parent::objectToArray($enterpriseCertificate, $keys);

        if (in_array('businessLicensePicture', $keys)) {
            $expression['businessLicensePicture'] = $enterpriseCertificate->getBusinessLicensePicture();
        }
        if (in_array('rejectReason', $keys)) {
            $expression['rejectReason'] = $enterpriseCertificate->getRejectReason();
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $enterpriseCertificate->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }
        if (isset($keys['member'])) {
            $expression['member'] = $this->getMemberTranslator()->objectToArray(
                $enterpriseCertificate->getMember(),
                $keys['member']
            );
        }

        return $expression;
    }
}
