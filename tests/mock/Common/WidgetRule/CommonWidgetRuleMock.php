<?php
namespace Sdk\Common\WidgetRule;

class CommonWidgetRuleMock extends CommonWidgetRule
{
    public function checkBirthDayCodePublic($idCard) : bool
    {
        return parent::checkBirthDayCode($idCard);
    }

    public function convertIDCard15to18Public($idCard) : string
    {
        return parent::convertIDCard15to18($idCard);
    }
}
