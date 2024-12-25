<?php
namespace Sdk\Member\NaturalPersonCertificate\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Utils\Traits\DesensitizationTrait;

use Sdk\Member\NaturalPersonCertificate\Model\NaturalPersonCertificate;
use Sdk\Member\NaturalPersonCertificate\Model\NullNaturalPersonCertificate;

use Sdk\User\Member\Translator\MemberTranslator;

class NaturalPersonCertificateTranslator implements ITranslator
{
    use TranslatorTrait, DesensitizationTrait;

    protected function getMemberTranslator() : MemberTranslator
    {
        return new MemberTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullNaturalPersonCertificate::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($naturalPersonCertificate, array $keys = array())
    {
        if (!$naturalPersonCertificate instanceof NaturalPersonCertificate) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'idCard',
                'subjectName',
                'frontIdCardPic',
                'backIdCardPic',
                'handheldIdCardPic',
                'rejectReason',
                'member' => ['id', 'subjectName'],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($naturalPersonCertificate->getId());
        }
        if (in_array('idCard', $keys)) {
            $expression['idCard'] = $naturalPersonCertificate->getIdCard();
            $expression['idCardDesensitization'] = $this->idCardDataDesensitization(
                $naturalPersonCertificate->getIdCard()
            );
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $naturalPersonCertificate->getSubjectName();
        }
        if (in_array('frontIdCardPic', $keys)) {
            $expression['frontIdCardPic'] = $naturalPersonCertificate->getFrontIdCardPic();
        }
        if (in_array('backIdCardPic', $keys)) {
            $expression['backIdCardPic'] = $naturalPersonCertificate->getBackIdCardPic();
        }
        if (in_array('handheldIdCardPic', $keys)) {
            $expression['handheldIdCardPic'] = $naturalPersonCertificate->getHandheldIdCardPic();
        }
        if (in_array('rejectReason', $keys)) {
            $expression['rejectReason'] = $naturalPersonCertificate->getRejectReason();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $naturalPersonCertificate->getStatus();
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $naturalPersonCertificate->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }
        if (isset($keys['member'])) {
            $expression['member'] = $this->getMemberTranslator()->objectToArray(
                $naturalPersonCertificate->getMember(),
                $keys['member']
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $naturalPersonCertificate->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $naturalPersonCertificate->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $naturalPersonCertificate->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $naturalPersonCertificate->getUpdateTime());
        }

        return $expression;
    }
}
