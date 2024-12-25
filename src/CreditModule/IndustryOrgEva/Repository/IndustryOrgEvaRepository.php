<?php
namespace Sdk\CreditModule\IndustryOrgEva\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\IndustryOrgEva\Adapter\IndustryOrgEva\IIndustryOrgEvaAdapter;
use Sdk\CreditModule\IndustryOrgEva\Adapter\IndustryOrgEva\IndustryOrgEvaMockAdapter;
use Sdk\CreditModule\IndustryOrgEva\Adapter\IndustryOrgEva\IndustryOrgEvaRestfulAdapter;

class IndustryOrgEvaRepository extends CommonRepository implements IIndustryOrgEvaAdapter
{
    const LIST_MODEL_UN = 'INDUSTRYORGEVA_LIST';
    const FETCH_ONE_MODEL_UN = 'INDUSTRYORGEVA_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new IndustryOrgEvaRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new IndustryOrgEvaMockAdapter()
        );
    }
}
