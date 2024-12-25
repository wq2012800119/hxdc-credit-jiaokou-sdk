<?php
namespace Sdk\Common\Utils\SafetyVerification\Traits;

use Sdk\Common\Utils\SafetyVerification\Csrf;

trait CsrfVerificationTrait
{
    protected function getCsrf() : Csrf
    {
        return new Csrf();
    }

    public function csrfVerification() : bool
    {
        if ($this->getRequest()->isAjax()) {
            return $this->ajaxCsrfVerification();
        }

        if ($this->getRequest()->isPostMethod()) {
            return $this->postMethodCsrfVerification();
        }

        if ($this->getRequest()->isGetMethod()) {
            return $this->getMethodCsrfVerification();
        }
        
        return false;
    }

    protected function ajaxCsrfVerification() : bool
    {
        $csrfToken = $this->getRequest()->getHeader('X-CSRF-TOKEN', '');

        return $this->getCsrf()->verification($csrfToken);
    }

    protected function postMethodCsrfVerification() : bool
    {
        $csrfToken = $this->getRequest()->post('csrfToken', '');

        return $this->getCsrf()->verification($csrfToken);
    }

    protected function getMethodCsrfVerification() : bool
    {
        return true;
    }
}
