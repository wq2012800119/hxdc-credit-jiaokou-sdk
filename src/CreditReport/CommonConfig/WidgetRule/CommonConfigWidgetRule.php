<?php
namespace Sdk\CreditReport\CommonConfig\WidgetRule;

use Marmot\Core;
use Sdk\Common\WidgetRule\CommonWidgetRule;

use Respect\Validation\Validator as V;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class CommonConfigWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const DIY_CONTENT_REQUIRED_KEYS_NAME = array(
        'logo',
        'backGrounds',
        'version',
        'issuingUnit',
        'reportDescription',
        'basicInfo',
        'administrationInfo',
        'honorInfo',
        'dishonestyInfo',
        'abnormalInfo',
        'commitmentInfo',
        'creditEvaluationInfo',
        'judicialDecisionInfo',
        'qualificationInfo',
        'otherInfo',
        'improveSuggestion',
        'localAdditionalContent'
    );
    
    const DIY_CONTENT_VALIDATE_METHOD = array(
        'logo' => 'logoValidate',
        'backGrounds' => 'backGroundsValidate',
        'version' => 'versionValidate',
        'issuingUnit' => 'issuingUnitValidate',
        'reportDescription' => 'reportDescriptionValidate',
        'basicInfo' => 'basicInfoValidate',
        'administrationInfo' => 'administrationInfoValidate',
        'honorInfo' => 'honorInfoValidate',
        'dishonestyInfo' => 'dishonestyInfoValidate',
        'abnormalInfo' => 'abnormalInfoValidate',
        'commitmentInfo' => 'commitmentInfoValidate',
        'creditEvaluationInfo' => 'creditEvaluationInfoValidate',
        'judicialDecisionInfo' => 'judicialDecisionInfoValidate',
        'qualificationInfo' => 'qualificationInfoValidate',
        'otherInfo' => 'otherInfoValidate',
        'improveSuggestion' => 'improveSuggestionValidate',
        'localAdditionalContent' => 'localAdditionalContentValidate'
    );

    /** 验证自定义内容格式
     * 1. 验证是否为数组格式
     * 2. 验证数组中必填项健值是否存在
     * 3. 验证每个字段值格式是否正确
     */
    public function diyContent($diyContent) : bool
    {
        return $this->diyContentTypeFormatValidate($diyContent)
            && $this->diyContentFormatRequiredKeysValidate($diyContent)
            && $this->diyContentFormatValidate($diyContent);
    }

    //1. 验证是否为数组格式
    protected function diyContentTypeFormatValidate($diyContent) : bool
    {
        if (!V::arrayType()->validate($diyContent) || empty($diyContent)) {
            Core::setLastError(CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证数组中必填项健值是否存在
    protected function diyContentFormatRequiredKeysValidate($diyContent) : bool
    {
        $requiredKeysName = self::DIY_CONTENT_REQUIRED_KEYS_NAME;
        $diyContentKeysName = array_keys($diyContent);

        foreach ($requiredKeysName as $keyName) {
            if (!in_array($keyName, $diyContentKeysName)) {
                Core::setLastError(
                    CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => 'diyContentRequiredKeys')
                );
                return false;
            }
        }

        return true;
    }
    
    //验证每个字段值格式是否正确
    protected function diyContentFormatValidate($diyContent) : bool
    {
        foreach ($diyContent as $key => $value) {
            $validateMethod = isset(self::DIY_CONTENT_VALIDATE_METHOD[$key]) ?
                                self::DIY_CONTENT_VALIDATE_METHOD[$key] :
                                '';
            if (!method_exists($this, $validateMethod)) {
                Core::setLastError(
                    CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => 'diyContentKey')
                );
                return false;
            }

            if (!$this->$validateMethod($value)) {
                return false;
            }
        }

        return true;
    }

    //logo
    protected function logoValidate($content) : bool
    {
        if (!$this->getCommonWidgetRule()->picture($content)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'logo')
            );
            return false;
        }
        
        return true;
    }

    //backGrounds
    protected function backGroundsValidate($content) : bool
    {
        if (!V::arrayType()->validate($content) || empty($content)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'backGrounds')
            );
            return false;
        }

        if (!isset($content['header']) || !isset($content['body']) || !isset($content['footer'])) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'backGrounds')
            );
            return false;
        }

        if (!$this->getCommonWidgetRule()->pictures($content)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'backGrounds')
            );
            return false;
        }
        
        return true;
    }

    const VERSION_MIN_LENGTH = 1;
    const VERSION_MAX_LENGTH = 10;
    public function versionValidate($version) : bool
    {
        if (!V::stringType()->length(
            self::VERSION_MIN_LENGTH,
            self::VERSION_MAX_LENGTH
        )->validate($version)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'version')
            );
            return false;
        }

        return true;
    }

    const ISSUING_UNIT_MIN_LENGTH = 1;
    const ISSUING_UNIT_MAX_LENGTH = 20;
    public function issuingUnitValidate($issuingUnit) : bool
    {
        if (!V::stringType()->length(
            self::ISSUING_UNIT_MIN_LENGTH,
            self::ISSUING_UNIT_MAX_LENGTH
        )->validate($issuingUnit)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'issuingUnit')
            );
            return false;
        }

        return true;
    }

    //reportDescription
    //验证报告说明长度：1-2000个字符
    protected function reportDescriptionValidate($content) : bool
    {
        if (!$this->getCommonWidgetRule()->content($content)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'reportDescription')
            );
            return false;
        }

        return true;
    }

    //basicInfo
    protected function basicInfoValidate($content) : bool
    {
        if (!V::arrayType()->validate($content) || empty($content) || !isset($content['status'])) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'basicInfo')
            );
            return false;
        }

        return $this->diyContentStatusValidate($content['status']);
    }

    //administrationInfo
    protected function administrationInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'administrationInfo');
    }

    //honorInfo
    protected function honorInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'honorInfo');
    }

    //dishonestyInfo
    protected function dishonestyInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'dishonestyInfo');
    }

    //abnormalInfo
    protected function abnormalInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'abnormalInfo');
    }

    //commitmentInfo
    protected function commitmentInfoValidate($content) : bool
    {
        if (!V::arrayType()->validate($content)
            || empty($content)
            || !isset($content['status'])
            || !isset($content['commitment'])
            || !isset($content['commitment']['status'])
        ) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'commitmentInfo')
            );
            return false;
        }

        return $this->diyContentStatusValidate($content['status'])
            && $this->diyContentStatusValidate($content['commitment']['status']);
    }

    //creditEvaluationInfo
    protected function creditEvaluationInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'creditEvaluationInfo');
    }

    //judicialDecisionInfo
    protected function judicialDecisionInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'judicialDecisionInfo');
    }

    //qualificationInfo
    protected function qualificationInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'qualificationInfo');
    }

    //otherInfo
    protected function otherInfoValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'otherInfo');
    }

    //improveSuggestion
    //验证报告说明长度：1-200个字符
    protected function improveSuggestionValidate($content) : bool
    {
        if (!V::arrayType()->validate($content)
            || empty($content)
            || !isset($content['status'])
            || !isset($content['content'])
        ) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'improveSuggestion')
            );
            return false;
        }

        if (!$this->diyContentStatusValidate($content['status'])) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'improveSuggestionStatus')
            );
            return false;
        }

        if (!$this->getCommonWidgetRule()->description($content['content'])) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'improveSuggestionContent')
            );
            return false;
        }

        return true;
    }

    //localAdditionalContent
    protected function localAdditionalContentValidate($content) : bool
    {
        return $this->commonDirectoryValidate($content, 'localAdditionalContent');
    }

    protected function commonDirectoryValidate($content, $pointer = '') : bool
    {
        if (!V::arrayType()->validate($content) || empty($content)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => $pointer)
            );
            return false;
        }

        if (!($this->commonDirectoryKeysValidate($content, $pointer)
            && $this->commonDirectoryStatusValidate($content)
            && $this->commonDirectoryDirectoriesValidate($content, $pointer)
        )) {
            return false;
        }

        return true;
    }

    protected function commonDirectoryKeysValidate($content, $pointer = '') : bool
    {
        if (!isset($content['status']) || !isset($content['directories'])) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => $pointer)
            );
            return false;
        }

        return true;
    }

    protected function commonDirectoryStatusValidate($content) : bool
    {
        return $this->diyContentStatusValidate($content['status']);
    }

    protected function commonDirectoryDirectoriesValidate($content, $pointer) : bool
    {
        $directories = $content['directories'];

        if (!V::arrayType()->validate($directories)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => $pointer)
            );
            return false;
        }

        foreach ($directories as $directory) {
            if (!isset($directory['id']) || !isset($directory['status'])) {
                Core::setLastError(
                    CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => $pointer.'directoriesKeys')
                );
                 return false;
            }

            if (!$this->diyContentIntValidate($directory['id'])) {
                Core::setLastError(
                    CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => $pointer.'directoriesId')
                );
                 return false;
            }

            if (!$this->diyContentStatusValidate($directory['status'])) {
                Core::setLastError(
                    CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => $pointer.'directoriesStatus')
                );
                 return false;
            }
        }

        return true;
    }

    protected function diyContentStatusValidate($status) : bool
    {
        if (!$this->getCommonWidgetRule()->status($status)) {
            Core::setLastError(
                CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'diyContentStatus')
            );
            return false;
        }

        return true;
    }

    protected function diyContentIntValidate($content, $pointer = '') : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($content)) {
            Core::setLastError(CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }
}
