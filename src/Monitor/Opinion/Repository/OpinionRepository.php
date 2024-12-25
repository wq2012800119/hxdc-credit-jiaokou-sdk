<?php
namespace Sdk\Monitor\Opinion\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Monitor\Opinion\Adapter\Opinion\IOpinionAdapter;
use Sdk\Monitor\Opinion\Adapter\Opinion\OpinionMockAdapter;
use Sdk\Monitor\Opinion\Adapter\Opinion\OpinionRestfulAdapter;

class OpinionRepository extends CommonRepository implements IOpinionAdapter
{
    const LIST_MODEL_UN = 'OPINION_LIST';
    const FETCH_ONE_MODEL_UN = 'OPINION_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new OpinionRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new OpinionMockAdapter()
        );
    }
}
