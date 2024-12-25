<?php
namespace Sdk\Evaluation\ScoreModel\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Evaluation\ScoreModel\Model\ScoreModel;

/**
 * @todo
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
class ScoreModelWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function name($name) : bool
    {
        if (!$this->getCommonWidgetRule()->name($name)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function description($description) : bool
    {
        if (!$this->getCommonWidgetRule()->content($description)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_DESCRIPTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function object($object) : bool
    {
        if (!V::arrayType()->validate($object) || empty($object)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_OBJECT_FORMAT_INCORRECT);
            return false;
        }

        if (count(array_intersect(ScoreModel::OBJECT, $object)) != count($object)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_OBJECT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const MAX_SCORE_MIN_VALUE = 1;
    const MAX_SCORE_MAX_VALUE = 2000;
    const BASE_SCORE_MIN_VALUE = 0;
    const BASE_SCORE_MAX_VALUE = 800;
    public function maxScore($maxScore, $baseScore) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($maxScore) ||
            $maxScore < self::MAX_SCORE_MIN_VALUE ||
            $maxScore > self::MAX_SCORE_MAX_VALUE
        ) {
            Core::setLastError(EVALUATION_SCORE_MODEL_MAX_SCORE_FORMAT_INCORRECT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->isNumericType($baseScore) ||
            $baseScore < self::BASE_SCORE_MIN_VALUE ||
            $baseScore > self::BASE_SCORE_MAX_VALUE
        ) {
            Core::setLastError(EVALUATION_SCORE_MODEL_BASE_SCORE_FORMAT_INCORRECT);
            return false;
        }

        if ($maxScore < $baseScore) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_BELOW_BASE_SCORE);
            return false;
        }

        return true;
    }

    const RANKS_MAX_COUNT = 5;
    public function ranks($ranks, $maxScore) : bool
    {
        return $this->ranksFormat($ranks)
            && $this->ranksScoreCheck($ranks, $maxScore)
            && $this->ranksUniqueCheck($ranks);
    }

    protected function ranksFormat($ranks) : bool
    {
        if (!V::arrayType()->validate($ranks) || empty($ranks)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT);
            return false;
        }

        if (count($ranks) > self::RANKS_MAX_COUNT) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_COUNT_FORMAT_INCORRECT);
            return false;
        }

        foreach ($ranks as $rank) {
            if (!$this->rankKeys($rank) ||
                !$this->rankRating($rank['rating']) ||
                !$this->rankReminder($rank['reminder']) ||
                !$this->rankLevelDescription($rank['levelDescription']) ||
                !$this->rankMinScore($rank['minScore']) ||
                !$this->rankMaxScore($rank['maxScore'])
            ) {
                return false;
            }
        }

        return true;
    }

    //验证评价等级数组的健值是否都存在
    protected function rankKeys($rank) : bool
    {
        if (!V::arrayType()->validate($rank) || empty($rank)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT);
            return false;
        }

        if (!isset($rank['rating']) ||
            !isset($rank['reminder']) ||
            !isset($rank['levelDescription']) ||
            !isset($rank['minScore']) ||
            !isset($rank['maxScore'])
        ) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const RANKS_RATING_MIN_LENGTH = 1;
    const RANKS_RATING_MAX_LENGTH = 5;
    //验证评价等级中的信用等级为1-5个字符
    protected function rankRating($rating) : bool
    {
        if (!V::stringType()->length(
            self::RANKS_RATING_MIN_LENGTH,
            self::RANKS_RATING_MAX_LENGTH
        )->validate($rating)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_RATING_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const RANKS_REMINDER_MIN_LENGTH = 1;
    const RANKS_REMINDER_MAX_LENGTH = 20;
    //验证评价等级中的信用提示为1-20个字符
    protected function rankReminder($reminder) : bool
    {
        if (!V::stringType()->length(
            self::RANKS_REMINDER_MIN_LENGTH,
            self::RANKS_REMINDER_MAX_LENGTH
        )->validate($reminder)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_REMINDER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const RANKS_LEVEL_DESCRIPTION_MIN_LENGTH = 0;
    const RANKS_LEVEL_DESCRIPTION_MAX_LENGTH = 200;
    //验证评价等级中的等级说明为0-200个字符
    protected function rankLevelDescription($levelDescription) : bool
    {
        if (!V::stringType()->length(
            self::RANKS_LEVEL_DESCRIPTION_MIN_LENGTH,
            self::RANKS_LEVEL_DESCRIPTION_MAX_LENGTH
        )->validate($levelDescription)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_LEVEL_DESCRIPTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证评价等级中的评价等级最低分数为数字
    protected function rankMinScore($minScore) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($minScore)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证评价等级中的评价等级最高分数为数字
    protected function rankMaxScore($maxScore) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($maxScore)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const SCORE_MODEL_MIN_SCORE = 0;
    protected function ranksScoreCheck($ranks, $maxScore) : bool
    {
        $ranksMaxScore = current(array_column($ranks, 'maxScore'));
        $ranksMinScores = array_column($ranks, 'minScore');
        $ranksMinScore = end($ranksMinScores);

        if ($ranksMaxScore != $maxScore) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_INCORRECT);
            return false;
        }

        if ($ranksMinScore != self::SCORE_MODEL_MIN_SCORE) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_INCORRECT);
            return false;
        }

        foreach ($ranks as $key => $rank) {
            //验证最低分不能高于最高分
            if ($rank['minScore'] > $rank['maxScore']) {
                Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_HIGHER_THAN_RANKS_MAX_SCORE);
                return false;
            }

            if ($rank['maxScore'] > $maxScore) {
                Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_HIGHER_THAN_MAX_SCORE);
                return false;
            }

            if ($rank['minScore'] < self::SCORE_MODEL_MIN_SCORE) {
                Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_BELOW_MIN_SCORE);
                return false;
            }
            //验证当前等级的最低分不能低于下一级的最高分, 且两个分数的差只能等于1
            if (isset($ranks[$key+1])) {
                $rankMinScore = $ranks[$key]['minScore'];
                $lastRankMaxScore = $ranks[$key+1]['maxScore'];
                $difference = $rankMinScore-$lastRankMaxScore;

                if ($rankMinScore < $lastRankMaxScore || $difference != 1) {
                    Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_SCORE_INCOHERENCE);
                    return false;
                }
            }
        }

        return true;
    }

    protected function ranksUniqueCheck($ranks) : bool
    {
        $rating = array_column($ranks, 'rating');

        if (count($ranks) != count(array_unique($rating))) {
            Core::setLastError(EVALUATION_SCORE_MODEL_RANKS_RATING_EXISTS);
            return false;
        }

        return true;
    }

    public function indicatorWeights($indicatorWeights) : bool
    {
        return $this->indicatorWeightsFormat($indicatorWeights) && $this->indicatorWeightsCheck($indicatorWeights);
    }

    protected function indicatorWeightsFormat($indicatorWeights) : bool
    {
        if (!V::arrayType()->validate($indicatorWeights) || empty($indicatorWeights)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT);
            return false;
        }

        foreach ($indicatorWeights as $indicatorWeight) {
            if (!$this->indicatorWeightKeys($indicatorWeight) ||
                !$this->indicatorWeightPercentage($indicatorWeight['percentage']) ||
                !$this->indicatorWeightScore($indicatorWeight['score']) ||
                !$this->indicatorWeightIndicatorId($indicatorWeight['indicatorId'])
            ) {
                return false;
            }
        }

        return true;
    }
    //验证评分指标权重数组的健值是否都存在
    protected function indicatorWeightKeys($indicatorWeight) : bool
    {
        if (!V::arrayType()->validate($indicatorWeight) || empty($indicatorWeight)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT);
            return false;
        }

        if (!isset($indicatorWeight['percentage']) ||
            !isset($indicatorWeight['score']) ||
            !isset($indicatorWeight['indicatorId'])
        ) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证评分指标权重中的占比为数字
    protected function indicatorWeightPercentage($percentage) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($percentage)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证评分指标权重中的单条分数为数字
    protected function indicatorWeightScore($score) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($score)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_SCORE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证评分指标权重中的评价指标为数字
    protected function indicatorWeightIndicatorId($indicatorId) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($indicatorId)) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_ID_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //评价模型的指标权重百分比没有100%
    const INDICATOR_WEIGHTS_PERCENTAGE_MAX_VALUE = 100;
    protected function indicatorWeightsCheck($indicatorWeights) : bool
    {
        $percentageSum = array_sum(array_column($indicatorWeights, 'percentage'));

        if ($percentageSum != self::INDICATOR_WEIGHTS_PERCENTAGE_MAX_VALUE) {
            Core::setLastError(EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_SUM_NOT_EQUAL_EXPECTED);
            return false;
        }

        return true;
    }
}
