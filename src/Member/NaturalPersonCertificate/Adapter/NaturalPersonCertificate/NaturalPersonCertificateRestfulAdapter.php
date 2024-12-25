<?php
namespace Sdk\Member\NaturalPersonCertificate\Adapter\NaturalPersonCertificate;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Member\NaturalPersonCertificate\Model\NullNaturalPersonCertificate;
use Sdk\Member\NaturalPersonCertificate\Translator\NaturalPersonCertificateRestfulTranslator;

class NaturalPersonCertificateRestfulAdapter extends CommonRestfulAdapter implements INaturalPersonCertificateAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => SUBJECT_NAME_FORMAT_INCORRECT,
            'idCard' => ID_CARD_FORMAT_INCORRECT,
            'frontIdCardPic' => PICTURE_FORMAT_INCORRECT,
            'backIdCardPic' => PICTURE_FORMAT_INCORRECT,
            'handheldIdCardPic' => PICTURE_FORMAT_INCORRECT,
            'rejectReason' => REASON_FORMAT_INCORRECT,
            'member' => MEMBER_FORMAT_INCORRECT,
            'naturalPersonCertificate' => PARAMETER_FORMAT_ERROR,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'naturalPersonCertificate' => NATURAL_PERSON_CERTIFICATE_EXISTS
        ),
        100004 => array(
            'member' => MEMBER_NOT_EXISTS,
            'naturalPersonCertificate' => NATURAL_PERSON_CERTIFICATE_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'NATURAL_PERSON_CERTIFICATE_LIST'=>[
            'fields' => [],
            'include' => 'member'
        ],
        'NATURAL_PERSON_CERTIFICATE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'member'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new NaturalPersonCertificateRestfulTranslator(),
            'members/naturalPersonCertificates',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullNaturalPersonCertificate::getInstance();
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
            'subjectName',
            'idCard',
            'frontIdCardPic',
            'backIdCardPic',
            'handheldIdCardPic'
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

    public function reject(IExamineAble $naturalPersonCertificate) : bool
    {
        $data = $this->getTranslator()->objectToArray($naturalPersonCertificate, array('rejectReason'));

        $this->patch(
            $this->getResource().'/'.$naturalPersonCertificate->getId().'/reject',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($naturalPersonCertificate);
            return true;
        }

        return false;
    }
}
