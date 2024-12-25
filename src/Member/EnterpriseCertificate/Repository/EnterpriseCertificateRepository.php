<?php
namespace Sdk\Member\EnterpriseCertificate\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Member\EnterpriseCertificate\Adapter\EnterpriseCertificate\IEnterpriseCertificateAdapter;
use Sdk\Member\EnterpriseCertificate\Adapter\EnterpriseCertificate\EnterpriseCertificateMockAdapter;
use Sdk\Member\EnterpriseCertificate\Adapter\EnterpriseCertificate\EnterpriseCertificateRestfulAdapter;

class EnterpriseCertificateRepository extends CommonRepository implements IEnterpriseCertificateAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'ENTERPRISE_CERTIFICATE_LIST';
    const FETCH_ONE_MODEL_UN = 'ENTERPRISE_CERTIFICATE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new EnterpriseCertificateRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new EnterpriseCertificateMockAdapter()
        );
    }
}
