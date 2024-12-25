<?php
namespace Sdk\Common\Utils\SafetyVerification\Traits;

use Sdk\Common\Utils\SafetyVerification\Csrf;

class SafetyVerificationTraitMock
{
    use SafetyVerificationTrait;

    public function safetyVerificationPublic() : bool
    {
        return $this->safetyVerification();
    }
}
