<?php
namespace Sdk\Resource\Directory\WidgetRule;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DirectoryWidgetRuleMock extends DirectoryWidgetRule
{
    public function itemNamePublic($name) : bool
    {
        return parent::itemName($name);
    }

    public function itemIdentifyPublic($identify) : bool
    {
        return parent::itemIdentify($identify);
    }

    public function itemsTypeFormatValidatePublic($items) : bool
    {
        return parent::itemsTypeFormatValidate($items);
    }

    public function itemsCountFormatValidatePublic($items) : bool
    {
        return parent::itemsCountFormatValidate($items);
    }

    public function itemsRequiredItemValidatePublic($items, $subjectCategory) : bool
    {
        return parent::itemsRequiredItemValidate($items, $subjectCategory);
    }

    public function itemsFormatValidatePublic($items) : bool
    {
        return parent::itemsFormatValidate($items);
    }

    public function itemFormatValidatePublic($items, $item) : bool
    {
        return parent::itemFormatValidate($items, $item);
    }

    public function itemKeyValidatePublic($item) : bool
    {
        return parent::itemKeyValidate($item);
    }

    public function itemNameValidatePublic($items, $item) : bool
    {
        return parent::itemNameValidate($items, $item);
    }

    public function itemNameUniquePublic($items) : bool
    {
        return parent::itemNameUnique($items);
    }

    public function itemIdentifyValidatePublic($items, $item) : bool
    {
        return parent::itemIdentifyValidate($items, $item);
    }

    public function itemIdentifyUniquePublic($items) : bool
    {
        return parent::itemIdentifyUnique($items);
    }

    public function itemDataTypeValidatePublic($item) : bool
    {
        return parent::itemDataTypeValidate($item);
    }

    public function itemDataLengthValidatePublic($item) : bool
    {
        return parent::itemDataLengthValidate($item);
    }

    public function itemDataLengthValidateEmptyPublic($dataLength) : bool
    {
        return parent::itemDataLengthValidateEmpty($dataLength);
    }

    public function itemDataLengthValidateNotEmptyPublic($dataType, $dataLength) : bool
    {
        return parent::itemDataLengthValidateNotEmpty($dataType, $dataLength);
    }

    public function itemOptionalRangeValidatePublic($item) : bool
    {
        return parent::itemOptionalRangeValidate($item);
    }

    public function itemOptionalRangeValidateEmptyPublic($optionalRange) : bool
    {
        return parent::itemOptionalRangeValidateEmpty($optionalRange);
    }

    public function itemOptionalRangeValidateNotEmptyPublic($optionalRange) : bool
    {
        return parent::itemOptionalRangeValidateNotEmpty($optionalRange);
    }

    public function itemRequiredValidatePublic($item) : bool
    {
        return parent::itemRequiredValidate($item);
    }

    public function itemDesensitizationValidatePublic($item) : bool
    {
        return parent::itemDesensitizationValidate($item);
    }

    public function itemDesensitizationRuleValidatePublic($item) : bool
    {
        return parent::itemDesensitizationRuleValidate($item);
    }

    public function itemDesensitizationRuleValidateNoPublic($desensitizationRule) : bool
    {
        return parent::itemDesensitizationRuleValidateNo($desensitizationRule);
    }

    public function itemDesensitizationRuleValidateYesPublic($desensitizationRule, $dataLength) : bool
    {
        return parent::itemDesensitizationRuleValidateYes($desensitizationRule, $dataLength);
    }

    public function itemPublicationRangeValidatePublic($item) : bool
    {
        return parent::itemPublicationRangeValidate($item);
    }

    public function itemRemarksValidatePublic($item) : bool
    {
        return parent::itemRemarksValidate($item);
    }
}
