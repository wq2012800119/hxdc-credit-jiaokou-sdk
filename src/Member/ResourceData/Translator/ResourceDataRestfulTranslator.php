<?php
namespace Sdk\Member\ResourceData\Translator;

use Sdk\Member\ResourceData\Model\ResourceData;
use Sdk\Member\ResourceData\Model\NullResourceData;
use Sdk\Resource\Data\Translator\DataRestfulTranslator;

use Sdk\User\Member\Translator\MemberRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class ResourceDataRestfulTranslator extends DataRestfulTranslator
{

    protected function getMemberRestfulTranslator() : MemberRestfulTranslator
    {
        return new MemberRestfulTranslator();
    }

    public function arrayToObject(array $expression, $resourceData = null)
    {
        if (empty($expression)) {
            return NullResourceData::getInstance();
        }

        if ($resourceData == null) {
            $resourceData = new ResourceData();
        }
       
        $resourceData = parent::arrayToObject($expression, $resourceData);

        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($attributes['certificateType'])) {
            $resourceData->setCertificateType($attributes['certificateType']);
        }
        if (isset($attributes['certificateId'])) {
            $resourceData->setCertificateId($attributes['certificateId']);
        }
        if (isset($attributes['attachments'])) {
            $resourceData->setAttachments($attributes['attachments']);
        }
        if (isset($attributes['rejectReason'])) {
            $resourceData->setRejectReason($attributes['rejectReason']);
        }
        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['member'])) {
            $memberArray = $this->relationshipFill($relationships['member'], $included);
            $member = $this->getMemberRestfulTranslator()->arrayToObject($memberArray);
            $resourceData->setMember($member);
        }
        
        return $resourceData;
    }

    public function objectToArray($resourceData, array $keys = array())
    {
        if (!$resourceData instanceof ResourceData) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'items',
                'staff',
                'directory',
                'certificateType',
                'certificateId',
                'attachments',
                'organization',
                'rejectReason',
                'member'
            );
        }

        $parentExpression = parent::objectToArray($resourceData, $keys);
        $parentAttributes = isset($parentExpression['data']['attributes']) ?
            $parentExpression['data']['attributes'] :
            [];
        $parentRelationships = isset($parentExpression['data']['relationships']) ?
            $parentExpression['data']['relationships'] :
            [];
        $attributes = $relationships = array();

        $expression = array(
            'data' => array(
                'type' => 'memberData'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $resourceData->getId();
        }
        if (in_array('certificateType', $keys)) {
            $attributes['certificateType'] = $resourceData->getCertificateType();
        }
        if (in_array('certificateId', $keys)) {
            $attributes['certificateId'] = $resourceData->getCertificateId();
        }
        if (in_array('attachments', $keys)) {
            $attributes['attachments'] = $resourceData->getAttachments();
        }
        if (in_array('rejectReason', $keys)) {
            $attributes['rejectReason'] = $resourceData->getRejectReason();
        }

        if (in_array('member', $keys)) {
            $relationships['member']['data'] = array(
                'type' => 'members',
                'id' => strval($resourceData->getMember()->getId())
            );
        }
        if (in_array('organization', $keys)) {
            $relationships['organization']['data'] = array(
                'type' => 'organizations',
                'id' => strval($resourceData->getOrganization()->getId())
            );
        }

        $expression['data']['attributes'] = empty($parentAttributes) ?
                $attributes :
                array_merge($parentAttributes, $attributes);

        $expression['data']['relationships'] = empty($parentRelationships) ?
                $relationships :
                array_merge($parentRelationships, $relationships);

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }
        
        return $expression;
    }
}
