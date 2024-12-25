<?php
namespace Sdk\Interaction\Appeal\Translator;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Interaction\Appeal\Model\Appeal;
use Sdk\Interaction\Appeal\Model\NullAppeal;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionRestfulTranslatorTrait;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class AppealRestfulTranslator implements IRestfulTranslator
{
    use CommonInteractionRestfulTranslatorTrait;
    
    protected function getDataRestfulTranslator() : DataRestfulTranslator
    {
        return new DataRestfulTranslator();
    }

    public function arrayToObject(array $expression, $appeal = null)
    {
        if (empty($expression)) {
            return NullAppeal::getInstance();
        }

        if ($appeal == null) {
            $appeal = new Appeal();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        $appeal = $this->arrayToObjectCommon($appeal, $expression);

        if (isset($relationships['data'])) {
            $dataArray = $this->relationshipFill($relationships['data'], $included);
            $data = $this->getDataRestfulTranslator()->arrayToObject($dataArray);
            $appeal->setData($data);
        }

        if (isset($attributes['evidences'])) {
            $appeal->setEvidences($attributes['evidences']);
        }
        
        return $appeal;
    }

    public function objectToArray($appeal, array $keys = array())
    {
        if (!$appeal instanceof Appeal) {
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
                'data'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'appeals'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $appeal->getId();
        }

        $expression = $this->objectToArrayCommon($appeal, $keys, $expression);

        if (in_array('evidences', $keys)) {
            $expression['data']['attributes']['evidences'] = $appeal->getEvidences();
        }

        if (in_array('data', $keys)) {
            $expression['data']['relationships']['data']['data'] = array(
                'type' => 'data',
                'id' => strval($appeal->getData()->getId())
            );
        }

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }

        return $expression;
    }
}
