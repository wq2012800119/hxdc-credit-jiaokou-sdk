<?php
namespace Sdk\Member\EnterpriseCertificate\Adapter\EnterpriseCertificate;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Member\EnterpriseCertificate\Model\NullEnterpriseCertificate;
use Sdk\Member\EnterpriseCertificate\Translator\EnterpriseCertificateRestfulTranslator;

class EnterpriseCertificateRestfulAdapter extends CommonRestfulAdapter implements IEnterpriseCertificateAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'ztmc' => ENTERPRISE_CERTIFICATE_ZTMC_FORMAT_INCORRECT,
            'ztlb' => ENTERPRISE_CERTIFICATE_ZTLB_FORMAT_INCORRECT,
            'tyshxydm' => ENTERPRISE_CERTIFICATE_TYSHXYDM_FORMAT_INCORRECT,
            'fddbr' => ENTERPRISE_CERTIFICATE_FDDBR_FORMAT_INCORRECT,
            'fddbrzjlx' => ENTERPRISE_CERTIFICATE_FDDBRZJLX_FORMAT_INCORRECT,
            'fddbrzjhm' => ENTERPRISE_CERTIFICATE_FDDBRZJHM_FORMAT_INCORRECT,
            'clrq' => ENTERPRISE_CERTIFICATE_CLRQ_FORMAT_INCORRECT,
            'yxq' => ENTERPRISE_CERTIFICATE_YXQ_FORMAT_INCORRECT,
            'dz' => ENTERPRISE_CERTIFICATE_DZ_FORMAT_INCORRECT,
            'djjg' => ENTERPRISE_CERTIFICATE_DJJG_FORMAT_INCORRECT,
            'gb' => ENTERPRISE_CERTIFICATE_GB_FORMAT_INCORRECT,
            'zczb' => ENTERPRISE_CERTIFICATE_ZCZB_FORMAT_INCORRECT,
            'zczbbz' => ENTERPRISE_CERTIFICATE_ZCZBBZ_FORMAT_INCORRECT,
            'hydm' => ENTERPRISE_CERTIFICATE_HYDM_FORMAT_INCORRECT,
            'lx' => ENTERPRISE_CERTIFICATE_LX_FORMAT_INCORRECT,
            'jyfw' => ENTERPRISE_CERTIFICATE_JYFW_FORMAT_INCORRECT,
            'jyzt' => ENTERPRISE_CERTIFICATE_JYZT_FORMAT_INCORRECT,
            'jyfwms' => ENTERPRISE_CERTIFICATE_JYFWMS_FORMAT_INCORRECT,
            'businessLicensePicture' => ENTERPRISE_CERTIFICATE_BUSINESS_LICENSE_PICTURE_FORMAT_INCORRECT,
            'rejectReason' => REASON_FORMAT_INCORRECT,
            'member' => MEMBER_FORMAT_INCORRECT,
            'enterpriseCertificate' => PARAMETER_FORMAT_ERROR,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'enterpriseCertificate' => ENTERPRISE_CERTIFICATE_EXISTS
        ),
        100004 => array(
            'member' => MEMBER_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'ENTERPRISE_CERTIFICATE_LIST'=>[
            'fields' => [
                'enterpriseCertificates' => 'ztmc,tyshxydm,jyzt,examineStatus,updateTime'
            ],
            'include' => 'member'
        ],
        'ENTERPRISE_CERTIFICATE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'member'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new EnterpriseCertificateRestfulTranslator(),
            'members/enterpriseCertificates',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullEnterpriseCertificate::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    private function insertAndUpdateCommonTranslatorKeys() : array
    {
        return array(
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
            'businessLicensePicture'
        );
    }

    protected function insertTranslatorKeys() : array
    {
        $keys = $this->insertAndUpdateCommonTranslatorKeys();
        array_push($keys, 'member');

        return $keys;
    }

    protected function updateTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }

    public function reject(IExamineAble $enterpriseCertificate) : bool
    {
        $data = $this->getTranslator()->objectToArray($enterpriseCertificate, array('rejectReason'));

        $this->patch(
            $this->getResource().'/'.$enterpriseCertificate->getId().'/reject',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($enterpriseCertificate);
            return true;
        }

        return false;
    }
}
