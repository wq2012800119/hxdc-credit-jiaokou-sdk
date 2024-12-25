<?php
namespace Sdk\Interaction\CommonInteraction\Adapter\CommonInteraction;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

trait CommonInteractionRestfulAdapterTrait
{
    abstract protected function getResource() : string;
    abstract protected function getTranslator() : IRestfulTranslator;

    public function accept(CommonInteraction $commonInteraction) : bool
    {
        $data = $this->getTranslator()->objectToArray($commonInteraction, array('replyContent', 'staff'));

        $this->patch(
            $this->getResource().'/'.$commonInteraction->getId().'/accept',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($commonInteraction);
            return true;
        }

        return false;
    }

    public function forward(CommonInteraction $commonInteraction) : bool
    {
        $data = $this->getTranslator()->objectToArray($commonInteraction, array('organization'));

        $this->patch(
            $this->getResource().'/'.$commonInteraction->getId().'/forward',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($commonInteraction);
            return true;
        }

        return false;
    }
    
    public function revoke(CommonInteraction $commonInteraction) : bool
    {
        $this->patch(
            $this->getResource().'/'.$commonInteraction->getId().'/revoke'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($commonInteraction);
            return true;
        }

        return false;
    }
}
