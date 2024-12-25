<?php
namespace Sdk\Interaction\Praise\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionTranslatorTrait;

use Sdk\Interaction\Praise\Model\Praise;
use Sdk\Interaction\Praise\Model\NullPraise;

use Sdk\Resource\Enterprise\Translator\EnterpriseTranslator;

class PraiseTranslator implements ITranslator
{
    use CommonInteractionTranslatorTrait;

    protected function getEnterpriseTranslator() : EnterpriseTranslator
    {
        return new EnterpriseTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullPraise::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'replyStatus',
                'replyTime',
                'replyContent',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'member' => ['id', 'subjectName'],
                'enterprise' => [],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = $this->objectToArrayCommon($praise, $keys);

        if (in_array('evidences', $keys)) {
            $expression['evidences'] = $praise->getEvidences();
        }

        if (isset($keys['enterprise'])) {
            $expression['enterprise'] = $this->getEnterpriseTranslator()->objectToArray(
                $praise->getEnterprise(),
                $keys['enterprise']
            );
        }

        return $expression;
    }
}
