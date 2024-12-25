<?php
namespace Sdk\Sensitive\Result\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Sensitive\Result\Adapter\SensitiveResult\ISensitiveResultAdapter;
use Sdk\Sensitive\Result\Adapter\SensitiveResult\SensitiveResultMockAdapter;
use Sdk\Sensitive\Result\Adapter\SensitiveResult\SensitiveResultRestfulAdapter;

class SensitiveResultRepository extends CommonRepository implements ISensitiveResultAdapter
{
    const LIST_MODEL_UN = 'SENSITIVE_RESULT_LIST';
    const FETCH_ONE_MODEL_UN = 'SENSITIVE_RESULT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new SensitiveResultRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new SensitiveResultMockAdapter()
        );
    }
}
