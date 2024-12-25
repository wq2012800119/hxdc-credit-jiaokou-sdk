<?php
namespace Sdk\Common\Utils\SafetyVerification\Traits;

use Sdk\Common\Utils\SafetyVerification\Csrf;

class CsrfVerificationTraitMock
{
    use CsrfVerificationTrait;

    public function getCsrfPublic() : Csrf
    {
        return $this->getCsrf();
    }

    public function csrfVerificationPublic() : bool
    {
        return $this->csrfVerification();
    }

    public function ajaxCsrfVerificationPublic() : bool
    {
        return $this->ajaxCsrfVerification();
    }

    public function postMethodCsrfVerificationPublic() : bool
    {
        return $this->postMethodCsrfVerification();
    }

    public function getMethodCsrfVerificationPublic() : bool
    {
        return $this->getMethodCsrfVerification();
    }
}
