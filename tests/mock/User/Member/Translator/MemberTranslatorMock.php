<?php
namespace Sdk\User\Member\Translator;

use Marmot\Interfaces\INull;

class MemberTranslatorMock extends MemberTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }
}
