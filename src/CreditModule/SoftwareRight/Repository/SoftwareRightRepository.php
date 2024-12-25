<?php
namespace Sdk\CreditModule\SoftwareRight\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\SoftwareRight\Adapter\SoftwareRight\ISoftwareRightAdapter;
use Sdk\CreditModule\SoftwareRight\Adapter\SoftwareRight\SoftwareRightMockAdapter;
use Sdk\CreditModule\SoftwareRight\Adapter\SoftwareRight\SoftwareRightRestfulAdapter;

class SoftwareRightRepository extends CommonRepository implements ISoftwareRightAdapter
{
    const LIST_MODEL_UN = 'SOFTWARERIGHT_LIST';
    const FETCH_ONE_MODEL_UN = 'SOFTWARERIGHT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new SoftwareRightRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new SoftwareRightMockAdapter()
        );
    }
}
