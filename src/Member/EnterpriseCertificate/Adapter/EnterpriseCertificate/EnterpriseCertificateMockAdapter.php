<?php
namespace Sdk\Member\EnterpriseCertificate\Adapter\EnterpriseCertificate;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Member\EnterpriseCertificate\Model\EnterpriseCertificate;

//use Sdk\Member\EnterpriseCertificate\Utils\MockObjectGenerate;

class EnterpriseCertificateMockAdapter implements IEnterpriseCertificateAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new EnterpriseCertificate($id);
        //return MockObjectGenerate::generateEnterpriseCertificate($id);
    }
}
