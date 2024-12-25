<?php
namespace Sdk\Interaction\Complaint\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionTranslatorTrait;

use Sdk\Interaction\Complaint\Model\Complaint;
use Sdk\Interaction\Complaint\Model\NullComplaint;

use Sdk\Resource\Enterprise\Translator\EnterpriseTranslator;

class ComplaintTranslator implements ITranslator
{
    use CommonInteractionTranslatorTrait;

    protected function getEnterpriseTranslator() : EnterpriseTranslator
    {
        return new EnterpriseTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullComplaint::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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

        $expression = $this->objectToArrayCommon($complaint, $keys);

        if (in_array('evidences', $keys)) {
            $expression['evidences'] = $complaint->getEvidences();
        }

        if (isset($keys['enterprise'])) {
            $expression['enterprise'] = $this->getEnterpriseTranslator()->objectToArray(
                $complaint->getEnterprise(),
                $keys['enterprise']
            );
        }

        return $expression;
    }
}
