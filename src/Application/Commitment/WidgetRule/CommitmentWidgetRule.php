<?php
namespace Sdk\Application\Commitment\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Application\Commitment\Model\Promise;
use Sdk\Application\Commitment\Model\Commitment;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CommitmentWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const CODE_LENGTH = 20;
    public function code($code) : bool
    {
        if (strlen($code) != self::CODE_LENGTH) {
            Core::setLastError(COMMITMENT_CODE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const SUBJECT_NAME_MIN_LENGTH = 1;
    const SUBJECT_NAME_MAX_LENGTH = 200;
    public function subjectName($subjectName) : bool
    {
        return $this->lengthWidgetRule(
            self::SUBJECT_NAME_MIN_LENGTH,
            self::SUBJECT_NAME_MAX_LENGTH,
            $subjectName,
            COMMITMENT_SUBJECT_NAME_FORMAT_INCORRECT
        );
    }

    public function subjectCategory($subjectCategory) : bool
    {
        if (!V::numeric()->positive()->validate($subjectCategory)
            || !in_array($subjectCategory, Commitment::SUBJECT_CATEGORY)
        ) {
            Core::setLastError(COMMITMENT_SUBJECT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function identify($subjectCategory, $identify) : bool
    {
        if ($subjectCategory == Commitment::SUBJECT_CATEGORY['ZRR']) {
            if (!$this->getCommonWidgetRule()->idCard($identify)) {
                Core::setLastError(COMMITMENT_IDENTIFY_FORMAT_INCORRECT);
                return false;
            }
        }

        if ($subjectCategory != Commitment::SUBJECT_CATEGORY['ZRR']) {
            if (!$this->getCommonWidgetRule()->unifiedIdentifier($identify)) {
                Core::setLastError(COMMITMENT_IDENTIFY_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    public function commitmentTypeId($commitmentTypeId) : bool
    {
        if (!V::numeric()->validate($commitmentTypeId)
            || !in_array($commitmentTypeId, Commitment::COMMITMENT_TYPE_ID)
        ) {
            Core::setLastError(COMMITMENT_TYPE_ID_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const COMMITMENT_TYPE_OTHER_MIN_LENGTH = 1;
    const COMMITMENT_TYPE_OTHER_MAX_LENGTH = 64;
    public function commitmentTypeOther($commitmentTypeId, $commitmentTypeOther) : bool
    {
        if ($commitmentTypeId == Commitment::COMMITMENT_TYPE_ID['QT']) {
            return $this->lengthWidgetRule(
                self::COMMITMENT_TYPE_OTHER_MIN_LENGTH,
                self::COMMITMENT_TYPE_OTHER_MAX_LENGTH,
                $commitmentTypeOther,
                COMMITMENT_TYPE_OTHER_FORMAT_INCORRECT
            );
        }

        if ($commitmentTypeId != Commitment::COMMITMENT_TYPE_ID['QT']) {
            if (!empty($commitmentTypeOther)) {
                Core::setLastError(COMMITMENT_TYPE_OTHER_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    const REASON_MIN_LENGTH = 1;
    const REASON_MAX_LENGTH = 512;
    public function reason($reason) : bool
    {
        return $this->lengthWidgetRule(
            self::REASON_MIN_LENGTH,
            self::REASON_MAX_LENGTH,
            $reason,
            COMMITMENT_REASON_FORMAT_INCORRECT
        );
    }

    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 4000;
    public function content($content) : bool
    {
        return $this->lengthWidgetRule(
            self::CONTENT_MIN_LENGTH,
            self::CONTENT_MAX_LENGTH,
            $content,
            COMMITMENT_CONTENT_FORMAT_INCORRECT
        );
    }

    const LIABILITY_BREACH_COMMITMENT_MIN_LENGTH = 1;
    const LIABILITY_BREACH_COMMITMENT_MAX_LENGTH = 4000;
    public function liabilityBreachCommitment($liabilityBreachCommitment) : bool
    {
        return $this->lengthWidgetRule(
            self::LIABILITY_BREACH_COMMITMENT_MIN_LENGTH,
            self::LIABILITY_BREACH_COMMITMENT_MAX_LENGTH,
            $liabilityBreachCommitment,
            COMMITMENT_LIABILITY_BREACH_COMMITMENT_FORMAT_INCORRECT
        );
    }

    public function commitmentDate($commitmentDate) :bool
    {
        return $this->unixTimeStampWidgetRule($commitmentDate, COMMITMENT_DATE_FORMAT_INCORRECT);
    }

    public function commitmentValidity($commitmentValidity) :bool
    {
        return $this->unixTimeStampWidgetRule($commitmentValidity, COMMITMENT_VALIDITY_FORMAT_INCORRECT);
    }

    public function fulfillmentStatus($fulfillmentStatus) : bool
    {
        if (!V::numeric()->positive()->validate($fulfillmentStatus)
            || !in_array($fulfillmentStatus, Promise::FULFILLMENT_STATUS)
        ) {
            Core::setLastError(COMMITMENT_FULFILLMENT_STATUS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const UNPERFORMED_COMMITMENT_CONTENT_MIN_LENGTH = 1;
    const UNPERFORMED_COMMITMENT_CONTENT_MAX_LENGTH = 4000;
    public function unperformedCommitmentContent($fulfillmentStatus, $unperformedCommitmentContent) : bool
    {
        if ($fulfillmentStatus != Promise::FULFILLMENT_STATUS['QBLX']) {
            return $this->lengthWidgetRule(
                self::UNPERFORMED_COMMITMENT_CONTENT_MIN_LENGTH,
                self::UNPERFORMED_COMMITMENT_CONTENT_MAX_LENGTH,
                $unperformedCommitmentContent,
                COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT
            );
        }

        if ($fulfillmentStatus == Promise::FULFILLMENT_STATUS['QBLX']) {
            if (!empty($unperformedCommitmentContent)) {
                Core::setLastError(COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    const LIABILITY_BREACH_COMMITMENT_CONTENT_MIN_LENGTH = 1;
    const LIABILITY_BREACH_COMMITMENT_CONTENT_MAX_LENGTH = 4000;
    /**
     * @todo
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function liabilityBreachCommitmentContent($fulfillmentStatus, $liabilityBreachCommitmentContent) : bool
    {
        if ($fulfillmentStatus != Promise::FULFILLMENT_STATUS['QBLX']) {
            return $this->lengthWidgetRule(
                self::LIABILITY_BREACH_COMMITMENT_CONTENT_MIN_LENGTH,
                self::LIABILITY_BREACH_COMMITMENT_CONTENT_MAX_LENGTH,
                $liabilityBreachCommitmentContent,
                COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT
            );
        }

        if ($fulfillmentStatus == Promise::FULFILLMENT_STATUS['QBLX']) {
            if (!empty($liabilityBreachCommitmentContent)) {
                Core::setLastError(COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    public function fulfillmentStatusDate($fulfillmentStatusDate) :bool
    {
        return $this->unixTimeStampWidgetRule(
            $fulfillmentStatusDate,
            COMMITMENT_FULFILLMENT_STATUS_DATE_FORMAT_INCORRECT
        );
    }

    const ACCEPTANCE_UNIT_MIN_LENGTH = 1;
    const ACCEPTANCE_UNIT_MAX_LENGTH = 200;
    public function acceptanceUnit($acceptanceUnit) : bool
    {
        return $this->lengthWidgetRule(
            self::ACCEPTANCE_UNIT_MIN_LENGTH,
            self::ACCEPTANCE_UNIT_MAX_LENGTH,
            $acceptanceUnit,
            COMMITMENT_ACCEPTANCE_UNIT_FORMAT_INCORRECT
        );
    }

    public function acceptanceUnitIdentify($acceptanceUnitIdentify) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($acceptanceUnitIdentify)) {
            Core::setLastError(COMMITMENT_ACCEPTANCE_UNIT_IDENTIFY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ACCEPTANCE_CONFIRM_UNIT_MIN_LENGTH = 1;
    const ACCEPTANCE_CONFIRM_UNIT_MAX_LENGTH = 200;
    public function acceptanceConfirmUnit($acceptanceConfirmUnit) : bool
    {
        return $this->lengthWidgetRule(
            self::ACCEPTANCE_CONFIRM_UNIT_MIN_LENGTH,
            self::ACCEPTANCE_CONFIRM_UNIT_MAX_LENGTH,
            $acceptanceConfirmUnit,
            COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_FORMAT_INCORRECT
        );
    }

    public function acceptanceConfirmUnitIdentify($acceptanceConfirmUnitIdentify) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($acceptanceConfirmUnitIdentify)) {
            Core::setLastError(COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_IDENTIFY_FORMAT_INCORRECT);
            return false;
        }
        
        return true;
    }

    public function publicationType($publicationType) : bool
    {
        if (!V::numeric()->positive()->validate($publicationType)
            || !in_array($publicationType, Commitment::PUBLICATION_TYPE)
        ) {
            Core::setLastError(COMMITMENT_PUBLICATION_TYPE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    
    const REMARKS_MIN_LENGTH = 1;
    const REMARKS_MAX_LENGTH = 512;
    public function remarks($remarks) : bool
    {
        return $this->lengthWidgetRule(
            self::REMARKS_MIN_LENGTH,
            self::REMARKS_MAX_LENGTH,
            $remarks,
            COMMITMENT_REMARKS_FORMAT_INCORRECT
        );
    }

    public function superviseStatus($superviseStatus) : bool
    {
        if (!V::numeric()->validate($superviseStatus)
            || !in_array($superviseStatus, Commitment::SUPERVISE_STATUS)
        ) {
            Core::setLastError(COMMITMENT_SUPERVISE_STATUS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    private function unixTimeStampWidgetRule(string $parameter, string $errorCode) : bool
    {
        if (strtotime(date('m-d-Y H:i:s', $parameter)) === $parameter) {
            Core::setLastError($errorCode);
            return false;
        }

        return true;
    }

    private function lengthWidgetRule(int $minLength, int $maxLength, string $parameter, string $errorCode) : bool
    {
        if (!V::stringType()->length($minLength, $maxLength)->validate($parameter)) {
            Core::setLastError($errorCode);
            return false;
        }

        return true;
    }
}
