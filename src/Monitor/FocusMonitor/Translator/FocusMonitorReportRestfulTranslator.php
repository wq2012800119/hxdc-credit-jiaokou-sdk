<?php
namespace Sdk\Monitor\FocusMonitor\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitorReport;
use Sdk\Monitor\FocusMonitor\Model\NullFocusMonitorReport;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class FocusMonitorReportRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getFocusMonitorRestfulTranslator() : FocusMonitorRestfulTranslator
    {
        return new FocusMonitorRestfulTranslator();
    }

    public function arrayToObject(array $expression, $focusMonitorReport = null)
    {
        if (empty($expression)) {
            return NullFocusMonitorReport::getInstance();
        }

        if ($focusMonitorReport == null) {
            $focusMonitorReport = new FocusMonitorReport();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $focusMonitorReport->setId($data['id']);
        }
        if (isset($attributes['dishonestyCount'])) {
            $focusMonitorReport->setDishonestyCount($attributes['dishonestyCount']);
        }
        if (isset($attributes['penaltyCount'])) {
            $focusMonitorReport->setPenaltyCount($attributes['penaltyCount']);
        }
        if (isset($attributes['penaltyWarningStatus'])) {
            $focusMonitorReport->setPenaltyWarningStatus($attributes['penaltyWarningStatus']);
        }
        if (isset($attributes['dishonestyWarningStatus'])) {
            $focusMonitorReport->setDishonestyWarningStatus($attributes['dishonestyWarningStatus']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['focusMonitor'])) {
            $focusMonitorArray = $this->relationshipFill($relationships['focusMonitor'], $included);
            $focusMonitor = $this->getFocusMonitorRestfulTranslator()->arrayToObject($focusMonitorArray);
            $focusMonitorReport->setFocusMonitor($focusMonitor);
        }
        
        return $focusMonitorReport;
    }

    public function objectToArray($focusMonitorReport, array $keys = array())
    {
        unset($focusMonitorReport);
        unset($keys);

        return [];
    }
}
