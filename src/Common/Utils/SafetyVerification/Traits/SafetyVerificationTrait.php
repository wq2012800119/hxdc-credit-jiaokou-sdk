<?php
namespace Sdk\Common\Utils\SafetyVerification\Traits;

trait SafetyVerificationTrait
{
    use CsrfVerificationTrait;

    public function safetyVerification() : bool
    {
        return $this->csrfVerification();
    }
}
