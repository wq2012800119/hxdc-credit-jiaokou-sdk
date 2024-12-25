<?php
namespace Sdk\Resource\Directory\WidgetRule;

use Marmot\Core;

use Respect\Validation\Validator as V;

use Sdk\Resource\Directory\Model\Directory;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DirectoryWidgetRule
{
    const NAME_MIN_LENGTH = 1;
    const NAME_MAX_LENGTH = 100;
    //验证名称长度：1-100个字符
    private function commonName($name, $errorCode) : bool
    {
        if (!V::stringType()->length(self::NAME_MIN_LENGTH, self::NAME_MAX_LENGTH)->validate($name)) {
            Core::setLastError($errorCode);
            return false;
        }

        return true;
    }

    public function name($name) : bool
    {
        return $this->commonName($name, DIRECTORY_NAME_FORMAT_INCORRECT);
    }

    protected function itemName($name) : bool
    {
        return $this->commonName($name, DIRECTORY_ITEMS_NAME_FORMAT_INCORRECT);
    }
    
    //验证标识长度：1-100个字符
    private function commonIdentify($identify, $errorCode) : bool
    {
        $reg = '/^[A-Z][A-Z_]{0,98}[A-Z]$/';
        if (!preg_match($reg, $identify)) {
            Core::setLastError($errorCode);
            return false;
        }

        return true;
    }

    public function identify($identify) : bool
    {
        return $this->commonIdentify($identify, DIRECTORY_IDENTIFY_FORMAT_INCORRECT);
    }

    protected function itemIdentify($identify) : bool
    {
        return $this->commonIdentify($identify, DIRECTORY_ITEMS_IDENTIFY_FORMAT_INCORRECT);
    }

    public function subjectCategory($subjectCategory) : bool
    {
        if (!V::arrayType()->validate($subjectCategory) || empty($subjectCategory)) {
            Core::setLastError(DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        if (count(array_intersect(Directory::SUBJECT_CATEGORY, $subjectCategory)) != count($subjectCategory)) {
            Core::setLastError(DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function infoCategory($infoCategory) : bool
    {
        if (!V::numeric()->positive()->validate($infoCategory)
            || !in_array($infoCategory, Directory::INFO_CATEGORY_OPTIONAL)
        ) {
            Core::setLastError(DIRECTORY_INFO_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function sourceUnits($sourceUnits) : bool
    {
        if (!V::arrayType()->validate($sourceUnits) || empty($sourceUnits)) {
            Core::setLastError(DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT);
            return false;
        }

        foreach ($sourceUnits as $sourceUnit) {
            if (!V::numeric()->positive()->validate($sourceUnit)) {
                Core::setLastError(DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    public function items($items, $subjectCategory) : bool
    {
        return $this->itemsTypeFormatValidate($items)
            && $this->itemsCountFormatValidate($items)
            && $this->itemsRequiredItemValidate($items, $subjectCategory)
            && $this->itemsFormatValidate($items);
    }

    //验证是否为数组格式
    protected function itemsTypeFormatValidate($items) : bool
    {
        if (!V::arrayType()->validate($items) || empty($items)) {
            Core::setLastError(DIRECTORY_ITEMS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ITEMS_MAX_COUNT = 54;
    //验证数量不能大于50
    protected function itemsCountFormatValidate($items) : bool
    {
        if (count($items) > self::ITEMS_MAX_COUNT) {
            Core::setLastError(DIRECTORY_ITEMS_COUNT_INCORRECT);
            return false;
        }

        return true;
    }

    const ITEMS_REQUIRED_ITEM = array(
        'ZTMC' => 'ZTMC',
        'TYSHXYDM' => 'TYSHXYDM',
        'ZJHM' => 'ZJHM'
    );
    protected function itemsRequiredItemValidate($items, $subjectCategory) : bool
    {
        $identifies = array();
        foreach ($items as $item) {
            if (isset($item['identify'])) {
                $identifies[] = $item['identify'];
            }
        }

        if (!in_array(self::ITEMS_REQUIRED_ITEM['ZTMC'], $identifies)) {
            Core::setLastError(DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT);
            return false;
        }

        if (in_array(Directory::SUBJECT_CATEGORY['ZRR'], $subjectCategory)) {
            if (!in_array(self::ITEMS_REQUIRED_ITEM['ZJHM'], $identifies)) {
                Core::setLastError(DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT);
                return false;
            }
        }

        if (!in_array(Directory::SUBJECT_CATEGORY['ZRR'], $subjectCategory)) {
            if (!in_array(self::ITEMS_REQUIRED_ITEM['TYSHXYDM'], $identifies)) {
                Core::setLastError(DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }
    /** 验证数组格式
     * 1. 验证数组的健值,是否包含'name', 'identify', 'dataType', 'dataLength', 'optionalRange',
     * 'required','desensitization', 'desensitizationRule', 'publicationRange', 'remarks'
     * 2. name 为1-100位字符,且在模板中唯一
     * 3. identify 为1-100位字符,且在模板中唯一
     * 4. dataType 是否在数据类型范围内
     * 5. dataLength 日期型和浮点型为空, 字符型1-10000个字符, 整数型1-10位长度,集合型,枚举型每个选项1-20位字符
     * 6. optionalRange 1-2000位字符, 枚举型、集合型 必填, 其他类型为空
     * 7. required 是否在是否必填状态范围内
     * 8. desensitization 是否在是否脱敏状态范围内
     * 9. desensitizationRule 当脱敏状态为脱敏时必填, 字符长度不能大于数据长度, 当脱敏状态为否时,该字段为空
     * 10. publicationRange 是否在公开范围范围内
     * 11. remarks 0-2000个字符
     */
    protected function itemsFormatValidate($items) : bool
    {
        foreach ($items as $item) {
            if (!$this->itemFormatValidate($items, $item)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function itemFormatValidate($items, $item) : bool
    {
        return $this->itemKeyValidate($item)
            && $this->itemNameValidate($items, $item)
            && $this->itemIdentifyValidate($items, $item)
            && $this->itemDataTypeValidate($item)
            && $this->itemDataLengthValidate($item)
            && $this->itemOptionalRangeValidate($item)
            && $this->itemRequiredValidate($item)
            && $this->itemDesensitizationValidate($item)
            && $this->itemDesensitizationRuleValidate($item)
            && $this->itemPublicationRangeValidate($item)
            && $this->itemRemarksValidate($item);
    }

    const ITEM_KEY = array('name', 'identify', 'dataType', 'dataLength', 'optionalRange', 'required',
    'desensitization', 'desensitizationRule', 'publicationRange', 'remarks');
    /** 验证数组格式
     * 1. 验证数组的健值,是否包含'name', 'identify', 'dataType', 'dataLength', 'optionalRange', 'required',
     * 'desensitization', 'desensitizationRule', 'publicationRange', 'remarks'
     */
    protected function itemKeyValidate($item) : bool
    {
        if (!V::arrayType()->validate($item) || empty($item)) {
            Core::setLastError(DIRECTORY_ITEMS_FORMAT_INCORRECT);
            return false;
        }

        $itemKeys = array_keys($item);
        if (!empty(array_diff($itemKeys, self::ITEM_KEY)) || !empty(array_diff(self::ITEM_KEY, $itemKeys))) {
            Core::setLastError(DIRECTORY_ITEMS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 2. name 为1-100位字符,且在模板中唯一
     */
    protected function itemNameValidate($items, $item) : bool
    {
        if (!isset($item['name'])) {
            Core::setLastError(DIRECTORY_ITEMS_FORMAT_INCORRECT);
            return false;
        }
        
        return $this->itemName($item['name']) && $this->itemNameUnique($items);
    }

    protected function itemNameUnique($items) : bool
    {
        $nameList = array_column($items, 'name');

        if (count($nameList) != count(array_unique($nameList))) {
            Core::setLastError(DIRECTORY_ITEMS_NAME_EXISTS);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 3. identify 为1-100位字符,且在模板中唯一
     */
    protected function itemIdentifyValidate($items, $item) : bool
    {
        if (!isset($item['identify'])) {
            Core::setLastError(DIRECTORY_ITEMS_FORMAT_INCORRECT);
            return false;
        }
        
        return $this->itemIdentify($item['identify']) && $this->itemIdentifyUnique($items);
    }

    protected function itemIdentifyUnique($items) : bool
    {
        $identifyList = array_column($items, 'identify');

        if (count($identifyList) != count(array_unique($identifyList))) {
            Core::setLastError(DIRECTORY_ITEMS_IDENTIFY_EXISTS);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 4. dataType 是否在数据类型范围内
     */
    protected function itemDataTypeValidate($item) : bool
    {
        if (!isset($item['dataType']) || !V::numeric()->positive()->validate($item['dataType'])
            || !in_array($item['dataType'], Directory::DATA_TYPE)
        ) {
            Core::setLastError(DIRECTORY_ITEMS_DATA_TYPE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 5. dataLength 日期型和浮点型为空, 字符型1-10000个字符, 整数型1-10位长度,集合型,枚举型每个选项1-20位字符
     */
    const DATA_LENGTH_MIN_LENGTH_ZFX = 1;
    const DATA_LENGTH_MAX_LENGTH_ZFX = 10000;
    const DATA_LENGTH_MIN_LENGTH_ZSX = 1;
    const DATA_LENGTH_MAX_LENGTH_ZSX = 10;
    const DATA_LENGTH_MIN_LENGTH_MJX_JHX = 1;
    const DATA_LENGTH_MAX_LENGTH_MJX_JHX = 20;
    protected function itemDataLengthValidate($item) : bool
    {
        if (!isset($item['dataType']) || !isset($item['dataLength'])) {
            Core::setLastError(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT);
            return false;
        }

        $dataType = $item['dataType'];
        $dataLength = $item['dataLength'];

        return ($dataType == Directory::DATA_TYPE['RQX'] || $dataType == Directory::DATA_TYPE['FDX']) ?
                    $this->itemDataLengthValidateEmpty($dataLength) :
                    $this->itemDataLengthValidateNotEmpty($dataType, $dataLength);
    }

    protected function itemDataLengthValidateEmpty($dataLength) : bool
    {
        if (!empty($dataLength)) {
            Core::setLastError(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    protected function itemDataLengthValidateNotEmpty($dataType, $dataLength) : bool
    {
        if ($dataType == Directory::DATA_TYPE['ZFX']) {
            if (!V::intVal()->between(
                self::DATA_LENGTH_MIN_LENGTH_ZFX,
                self::DATA_LENGTH_MAX_LENGTH_ZFX
            )->validate($dataLength)) {
                Core::setLastError(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT);
                return false;
            }
        }
        if ($dataType == Directory::DATA_TYPE['ZSX']) {
            if (!V::intVal()->between(
                self::DATA_LENGTH_MIN_LENGTH_ZSX,
                self::DATA_LENGTH_MAX_LENGTH_ZSX
            )->validate($dataLength)) {
                Core::setLastError(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT);
                return false;
            }
        }

        if ($dataType == Directory::DATA_TYPE['MJX'] || $dataType == Directory::DATA_TYPE['JHX']) {
            if (!V::intVal()->between(
                self::DATA_LENGTH_MIN_LENGTH_MJX_JHX,
                self::DATA_LENGTH_MAX_LENGTH_MJX_JHX
            )->validate($dataLength)) {
                Core::setLastError(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    /** 验证数组格式
     * 6. optionalRange 1-2000位字符, 枚举型、集合型 必填, 其他类型为空
     */
    const OPTIONAL_RANGE_MIN_LENGTH = 1;
    const OPTIONAL_RANGE_MAX_LENGTH = 2000;
    protected function itemOptionalRangeValidate($item) : bool
    {
        if (!isset($item['dataType']) || !isset($item['optionalRange'])) {
            Core::setLastError(DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT);
            return false;
        }

        $dataType = $item['dataType'];
        $optionalRange = $item['optionalRange'];

        return ($dataType != Directory::DATA_TYPE['MJX'] && $dataType != Directory::DATA_TYPE['JHX']) ?
                $this->itemOptionalRangeValidateEmpty($optionalRange) :
                $this->itemOptionalRangeValidateNotEmpty($optionalRange);
    }

    protected function itemOptionalRangeValidateEmpty($optionalRange) : bool
    {
        if (!empty($optionalRange)) {
            Core::setLastError(DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    protected function itemOptionalRangeValidateNotEmpty($optionalRange) : bool
    {
        if (!V::stringType()->length(
            self::OPTIONAL_RANGE_MIN_LENGTH,
            self::OPTIONAL_RANGE_MAX_LENGTH
        )->validate($optionalRange)) {
            Core::setLastError(DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    /** 验证数组格式
     * 7. required 是否在是否必填状态范围内
     */
    protected function itemRequiredValidate($item) : bool
    {
        if (!isset($item['required'])) {
            Core::setLastError(DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT);
            return false;
        }

        $required = $item['required'];
        if (!V::numeric()->validate($required) || !in_array($required, Directory::REQUIRED)) {
            Core::setLastError(DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 8. desensitization 是否在是否脱敏状态范围内
     */
    protected function itemDesensitizationValidate($item) : bool
    {
        if (!isset($item['desensitization'])) {
            Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT);
            return false;
        }

        $desensitization = $item['desensitization'];
        if (!V::numeric()->validate($desensitization) || !in_array($desensitization, Directory::DESENSITIZATION)) {
            Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    /** 验证数组格式
     * 9. desensitizationRule 当脱敏状态为脱敏时必填, 字符长度不能大于数据长度, 当脱敏状态为否时,该字段为空
     */
    const DESENSITIZATION_RULE_COUNT = 2;
    protected function itemDesensitizationRuleValidate($item) : bool
    {
        if (!isset($item['desensitization'])
            || !isset($item['desensitizationRule'])
            || !isset($item['dataLength'])
        ) {
            Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT);
            return false;
        }

        $desensitization = $item['desensitization'];
        $desensitizationRule = $item['desensitizationRule'];
        $dataLength = $item['dataLength'];

        return $desensitization == Directory::DESENSITIZATION['NO'] ?
                $this->itemDesensitizationRuleValidateNo($desensitizationRule) :
                $this->itemDesensitizationRuleValidateYes($desensitizationRule, $dataLength);
    }

    protected function itemDesensitizationRuleValidateNo($desensitizationRule) : bool
    {
        if (!empty($desensitizationRule)) {
            Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    protected function itemDesensitizationRuleValidateYes($desensitizationRule, $dataLength) : bool
    {
        if (!V::arrayType()->validate($desensitizationRule)
            || empty($desensitizationRule)
            || count($desensitizationRule) != self::DESENSITIZATION_RULE_COUNT
        ) {
            Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT);
            return false;
        }

        $length = 0;
        foreach ($desensitizationRule as $rule) {
            $length+=$rule;
            if ($rule > $dataLength) {
                Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT);
                return false;
            }
        }

        if ($length > $dataLength) {
            Core::setLastError(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 10. publicationRange 是否在公开范围范围内
     */
    protected function itemPublicationRangeValidate($item) : bool
    {
        if (!isset($item['publicationRange'])) {
            Core::setLastError(DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT);
            return false;
        }

        $publicationRange = $item['publicationRange'];
        if (!V::numeric()->positive()->validate($publicationRange)
            || !in_array($publicationRange, Directory::PUBLICATION_RANGE)
        ) {
            Core::setLastError(DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证数组格式
     * 11. remarks 0-2000个字符
     */
    const REMARKS_MIN_LENGTH = 0;
    const REMARKS_MAX_LENGTH = 2000;
    protected function itemRemarksValidate($item) : bool
    {
        if (!isset($item['remarks'])) {
            Core::setLastError(DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT);
            return false;
        }

        if (!V::stringType()->length(
            self::REMARKS_MIN_LENGTH,
            self::REMARKS_MAX_LENGTH
        )->validate($item['remarks'])
        ) {
            Core::setLastError(DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}
