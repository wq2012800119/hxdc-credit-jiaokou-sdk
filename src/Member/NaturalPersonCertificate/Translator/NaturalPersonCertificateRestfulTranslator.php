<?php
namespace Sdk\Member\NaturalPersonCertificate\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Member\NaturalPersonCertificate\Model\NaturalPersonCertificate;
use Sdk\Member\NaturalPersonCertificate\Model\NullNaturalPersonCertificate;

use Sdk\User\Member\Translator\MemberRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class NaturalPersonCertificateRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getMemberRestfulTranslator() : MemberRestfulTranslator
    {
        return new MemberRestfulTranslator();
    }

    public function arrayToObject(array $expression, $naturalPersonCertificate = null)
    {
        if (empty($expression)) {
            return NullNaturalPersonCertificate::getInstance();
        }

        if ($naturalPersonCertificate == null) {
            $naturalPersonCertificate = new NaturalPersonCertificate();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $naturalPersonCertificate->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $naturalPersonCertificate->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['idCard'])) {
            $naturalPersonCertificate->setIdCard($attributes['idCard']);
        }
        if (isset($attributes['frontIdCardPic'])) {
            $naturalPersonCertificate->setFrontIdCardPic($attributes['frontIdCardPic']);
        }
        if (isset($attributes['backIdCardPic'])) {
            $naturalPersonCertificate->setBackIdCardPic($attributes['backIdCardPic']);
        }
        if (isset($attributes['handheldIdCardPic'])) {
            $naturalPersonCertificate->setHandheldIdCardPic($attributes['handheldIdCardPic']);
        }
        if (isset($attributes['rejectReason'])) {
            $naturalPersonCertificate->setRejectReason($attributes['rejectReason']);
        }
        if (isset($attributes['examineStatus'])) {
            $naturalPersonCertificate->setExamineStatus($attributes['examineStatus']);
        }
        if (isset($attributes['status'])) {
            $naturalPersonCertificate->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $naturalPersonCertificate->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $naturalPersonCertificate->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $naturalPersonCertificate->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['member'])) {
            $memberArray = $this->relationshipFill($relationships['member'], $included);
            $member = $this->getMemberRestfulTranslator()->arrayToObject($memberArray);
            $naturalPersonCertificate->setMember($member);
        }
        
        return $naturalPersonCertificate;
    }

    public function objectToArray($naturalPersonCertificate, array $keys = array())
    {
        if (!$naturalPersonCertificate instanceof NaturalPersonCertificate) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'idCard',
                'frontIdCardPic',
                'backIdCardPic',
                'handheldIdCardPic',
                'rejectReason',
                'member'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'naturalPersonCertificates'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $naturalPersonCertificate->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $naturalPersonCertificate->getSubjectName();
        }
        if (in_array('idCard', $keys)) {
            $attributes['idCard'] = $naturalPersonCertificate->getIdCard();
        }
        if (in_array('frontIdCardPic', $keys)) {
            $attributes['frontIdCardPic'] = $naturalPersonCertificate->getFrontIdCardPic();
        }
        if (in_array('backIdCardPic', $keys)) {
            $attributes['backIdCardPic'] = $naturalPersonCertificate->getBackIdCardPic();
        }
        if (in_array('handheldIdCardPic', $keys)) {
            $attributes['handheldIdCardPic'] = $naturalPersonCertificate->getHandheldIdCardPic();
        }
        if (in_array('rejectReason', $keys)) {
            $attributes['rejectReason'] = $naturalPersonCertificate->getRejectReason();
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('member', $keys)) {
            $expression['data']['relationships']['member']['data'] = array(
                'type' => 'members',
                'id' => strval($naturalPersonCertificate->getMember()->getId())
            );
        }
        
        return $expression;
    }
}
