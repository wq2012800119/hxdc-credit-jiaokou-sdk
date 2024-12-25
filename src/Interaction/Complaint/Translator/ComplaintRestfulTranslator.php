<?php
namespace Sdk\Interaction\Complaint\Translator;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Interaction\Complaint\Model\Complaint;
use Sdk\Interaction\Complaint\Model\NullComplaint;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionRestfulTranslatorTrait;

use Sdk\Resource\Enterprise\Translator\EnterpriseRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class ComplaintRestfulTranslator implements IRestfulTranslator
{
    use CommonInteractionRestfulTranslatorTrait;
    
    protected function getEnterpriseRestfulTranslator() : EnterpriseRestfulTranslator
    {
        return new EnterpriseRestfulTranslator();
    }

    public function arrayToObject(array $expression, $complaint = null)
    {
        if (empty($expression)) {
            return NullComplaint::getInstance();
        }

        if ($complaint == null) {
            $complaint = new Complaint();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        $complaint = $this->arrayToObjectCommon($complaint, $expression);

        if (isset($relationships['enterprise'])) {
            $enterpriseArray = $this->relationshipFill($relationships['enterprise'], $included);
            $enterprise = $this->getEnterpriseRestfulTranslator()->arrayToObject($enterpriseArray);
            $complaint->setEnterprise($enterprise);
        }

        if (isset($attributes['evidences'])) {
            $complaint->setEvidences($attributes['evidences']);
        }
        
        return $complaint;
    }

    public function objectToArray($complaint, array $keys = array())
    {
        if (!$complaint instanceof Complaint) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'realName',
                'cellphone',
                'email',
                'title',
                'content',
                'evidences',
                'member',
                'replyContent',
                'staff',
                'enterprise'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'complaints'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $complaint->getId();
        }

        $expression = $this->objectToArrayCommon($complaint, $keys, $expression);

        if (in_array('evidences', $keys)) {
            $expression['data']['attributes']['evidences'] = $complaint->getEvidences();
        }

        if (in_array('enterprise', $keys)) {
            $expression['data']['relationships']['enterprise']['data'] = array(
                'type' => 'enterprises',
                'id' => strval($complaint->getEnterprise()->getId())
            );
        }

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }

        return $expression;
    }
}
