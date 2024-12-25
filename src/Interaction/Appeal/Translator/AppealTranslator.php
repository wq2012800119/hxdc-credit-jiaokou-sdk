<?php
namespace Sdk\Interaction\Appeal\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionTranslatorTrait;

use Sdk\Interaction\Appeal\Model\Appeal;
use Sdk\Interaction\Appeal\Model\NullAppeal;

use Sdk\Resource\Data\Translator\DataTranslator;

class AppealTranslator implements ITranslator
{
    use CommonInteractionTranslatorTrait;

    protected function getDataTranslator() : DataTranslator
    {
        return new DataTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullAppeal::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'replyStatus',
                'replyTime',
                'replyContent',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'member' => ['id', 'subjectName'],
                'data' => [],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = $this->objectToArrayCommon($appeal, $keys);

        if (in_array('evidences', $keys)) {
            $expression['evidences'] = $appeal->getEvidences();
        }

        if (isset($keys['data'])) {
            $expression['data'] = $this->getDataTranslator()->objectToArray(
                $appeal->getData(),
                $keys['data']
            );
        }

        return $expression;
    }
}
