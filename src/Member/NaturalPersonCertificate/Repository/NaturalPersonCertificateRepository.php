<?php
namespace Sdk\Member\NaturalPersonCertificate\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Member\NaturalPersonCertificate\Adapter\NaturalPersonCertificate\INaturalPersonCertificateAdapter;
use Sdk\Member\NaturalPersonCertificate\Adapter\NaturalPersonCertificate\NaturalPersonCertificateMockAdapter;
use Sdk\Member\NaturalPersonCertificate\Adapter\NaturalPersonCertificate\NaturalPersonCertificateRestfulAdapter;

class NaturalPersonCertificateRepository extends CommonRepository implements INaturalPersonCertificateAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'NATURAL_PERSON_CERTIFICATE_LIST';
    const FETCH_ONE_MODEL_UN = 'NATURAL_PERSON_CERTIFICATE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new NaturalPersonCertificateRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new NaturalPersonCertificateMockAdapter()
        );
    }
}
