<?php
namespace Sdk\Monitor\FocusMonitor\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitorReport;
use Sdk\Monitor\FocusMonitor\Model\NullFocusMonitorReport;

class FocusMonitorReportTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getFocusMonitorTranslator() : FocusMonitorTranslator
    {
        return new FocusMonitorTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullFocusMonitorReport::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($focusMonitorReport, array $keys = array())
    {
        if (!$focusMonitorReport instanceof FocusMonitorReport) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'dishonestyCount',
                'penaltyCount',
                'dishonestyWarningStatus',
                'penaltyWarningStatus',
                'focusMonitor' => []
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($focusMonitorReport->getId());
        }
        if (in_array('dishonestyCount', $keys)) {
            $expression['dishonestyCount'] = $focusMonitorReport->getDishonestyCount();
        }
        if (in_array('penaltyCount', $keys)) {
            $expression['penaltyCount'] = $focusMonitorReport->getPenaltyCount();
        }
        if (in_array('dishonestyWarningStatus', $keys)) {
            $expression['dishonestyWarningStatus'] = $this->typeFormatConversion(
                $focusMonitorReport->getDishonestyWarningStatus(),
                FocusMonitorReport::DISHONESTY_WARNING_STATUS_CN
            );
        }
        if (in_array('penaltyWarningStatus', $keys)) {
            $expression['penaltyWarningStatus'] = $this->typeFormatConversion(
                $focusMonitorReport->getPenaltyWarningStatus(),
                FocusMonitorReport::PENALTY_WARNING_STATUS_CN
            );
        }

        if (isset($keys['focusMonitor'])) {
            $expression['focusMonitor'] = $this->getFocusMonitorTranslator()->objectToArray(
                $focusMonitorReport->getFocusMonitor(),
                $keys['focusMonitor']
            );
        }
        return $expression;
    }
}
