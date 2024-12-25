<?php
namespace Sdk\Interaction\Praise\Translator;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Interaction\Praise\Model\Praise;
use Sdk\Interaction\Praise\Model\NullPraise;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionRestfulTranslatorTrait;

use Sdk\Resource\Enterprise\Translator\EnterpriseRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class PraiseRestfulTranslator implements IRestfulTranslator
{
    use CommonInteractionRestfulTranslatorTrait;
    
    protected function getEnterpriseRestfulTranslator() : EnterpriseRestfulTranslator
    {
        return new EnterpriseRestfulTranslator();
    }

    public function arrayToObject(array $expression, $praise = null)
    {
        if (empty($expression)) {
            return NullPraise::getInstance();
        }

        if ($praise == null) {
            $praise = new Praise();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        $praise = $this->arrayToObjectCommon($praise, $expression);

        if (isset($relationships['enterprise'])) {
            $enterpriseArray = $this->relationshipFill($relationships['enterprise'], $included);
            $enterprise = $this->getEnterpriseRestfulTranslator()->arrayToObject($enterpriseArray);
            $praise->setEnterprise($enterprise);
        }

        if (isset($attributes['evidences'])) {
            $praise->setEvidences($attributes['evidences']);
        }
        
        return $praise;
    }

    public function objectToArray($praise, array $keys = array())
    {
        if (!$praise instanceof Praise) {
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
                'type' => 'praises'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $praise->getId();
        }

        $expression = $this->objectToArrayCommon($praise, $keys, $expression);

        if (in_array('evidences', $keys)) {
            $expression['data']['attributes']['evidences'] = $praise->getEvidences();
        }

        if (in_array('enterprise', $keys)) {
            $expression['data']['relationships']['enterprise']['data'] = array(
                'type' => 'enterprises',
                'id' => strval($praise->getEnterprise()->getId())
            );
        }

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }

        return $expression;
    }
}
