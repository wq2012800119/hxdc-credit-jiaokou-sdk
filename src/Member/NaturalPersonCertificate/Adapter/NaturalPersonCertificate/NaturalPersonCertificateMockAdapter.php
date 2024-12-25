<?php
namespace Sdk\Member\NaturalPersonCertificate\Adapter\NaturalPersonCertificate;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Member\NaturalPersonCertificate\Model\NaturalPersonCertificate;

//use Sdk\Member\NaturalPersonCertificate\Utils\MockObjectGenerate;

class NaturalPersonCertificateMockAdapter implements INaturalPersonCertificateAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new NaturalPersonCertificate($id);
        //return MockObjectGenerate::generateNaturalPersonCertificate($id);
    }
}
