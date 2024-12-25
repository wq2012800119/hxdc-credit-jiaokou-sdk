<?php
namespace Sdk\CreditModule\Certification\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\Certification\Adapter\Certification\ICertificationAdapter;
use Sdk\CreditModule\Certification\Adapter\Certification\CertificationMockAdapter;
use Sdk\CreditModule\Certification\Adapter\Certification\CertificationRestfulAdapter;

class CertificationRepository extends CommonRepository implements ICertificationAdapter
{
    const LIST_MODEL_UN = 'CERTIFICATION_LIST';
    const FETCH_ONE_MODEL_UN = 'CERTIFICATION_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new CertificationRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new CertificationMockAdapter()
        );
    }
}
