<?php
namespace Sdk\CreditModule\Copyright\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\Copyright\Adapter\Copyright\ICopyrightAdapter;
use Sdk\CreditModule\Copyright\Adapter\Copyright\CopyrightMockAdapter;
use Sdk\CreditModule\Copyright\Adapter\Copyright\CopyrightRestfulAdapter;

class CopyrightRepository extends CommonRepository implements ICopyrightAdapter
{
    const LIST_MODEL_UN = 'COPYRIGHT_LIST';
    const FETCH_ONE_MODEL_UN = 'COPYRIGHT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new CopyrightRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new CopyrightMockAdapter()
        );
    }
}
