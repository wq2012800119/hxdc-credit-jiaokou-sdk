<?php
namespace Sdk\Rap\Memorandum\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Rap\Memorandum\Adapter\Memorandum\IMemorandumAdapter;
use Sdk\Rap\Memorandum\Adapter\Memorandum\MemorandumMockAdapter;
use Sdk\Rap\Memorandum\Adapter\Memorandum\MemorandumRestfulAdapter;

class MemorandumRepository extends CommonRepository implements IMemorandumAdapter
{
    const LIST_MODEL_UN = 'MEMORANDUM_LIST';
    const FETCH_ONE_MODEL_UN = 'MEMORANDUM_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new MemorandumRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new MemorandumMockAdapter()
        );
    }
}
