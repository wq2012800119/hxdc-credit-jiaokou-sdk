<?php
namespace Sdk\Article\Article\WidgetRule;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class ArticleWidgetRuleMock extends ArticleWidgetRule
{
    public function getCommonWidgetRulePublic() : CommonWidgetRule
    {
        return parent::getCommonWidgetRule();
    }
}
