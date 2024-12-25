<?php
namespace Sdk\Sensitive\Word\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Sensitive\Word\Model\SensitiveWord;
use Sdk\Sensitive\Word\Adapter\SensitiveWord\ISensitiveWordAdapter;
use Sdk\Sensitive\Word\Adapter\SensitiveWord\SensitiveWordMockAdapter;
use Sdk\Sensitive\Word\Adapter\SensitiveWord\SensitiveWordRestfulAdapter;

class SensitiveWordRepository extends CommonRepository implements ISensitiveWordAdapter
{
    const LIST_MODEL_UN = 'SENSITIVE_WORD_LIST';
    const FETCH_ONE_MODEL_UN = 'SENSITIVE_WORD_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new SensitiveWordRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new SensitiveWordMockAdapter()
        );
    }

    public function batchProcess(SensitiveWord $sensitiveWord) : bool
    {
        return $this->getAdapter()->batchProcess($sensitiveWord);
    }
}
