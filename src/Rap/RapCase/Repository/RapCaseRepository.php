<?php
namespace Sdk\Rap\RapCase\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Rap\RapCase\Adapter\RapCase\IRapCaseAdapter;
use Sdk\Rap\RapCase\Adapter\RapCase\RapCaseMockAdapter;
use Sdk\Rap\RapCase\Adapter\RapCase\RapCaseRestfulAdapter;

class RapCaseRepository extends CommonRepository implements IRapCaseAdapter
{
    const LIST_MODEL_UN = 'CASE_LIST';
    const FETCH_ONE_MODEL_UN = 'CASE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new RapCaseRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new RapCaseMockAdapter()
        );
    }
}
