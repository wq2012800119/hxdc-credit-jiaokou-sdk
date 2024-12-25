<?php
namespace Sdk\Common\Utils\Traits;

class CharacterGeneratorTraitMock
{
    use CharacterGeneratorTrait;

    public function randomCharPublic($length = 6, $chars = null) : string
    {
        return $this->randomChar($length, $chars);
    }
}
