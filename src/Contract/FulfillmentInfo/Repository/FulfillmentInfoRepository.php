<?php
namespace Sdk\Contract\FulfillmentInfo\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Contract\FulfillmentInfo\Adapter\FulfillmentInfo\IFulfillmentInfoAdapter;
use Sdk\Contract\FulfillmentInfo\Adapter\FulfillmentInfo\FulfillmentInfoMockAdapter;
use Sdk\Contract\FulfillmentInfo\Adapter\FulfillmentInfo\FulfillmentInfoRestfulAdapter;

class FulfillmentInfoRepository extends CommonRepository implements IFulfillmentInfoAdapter
{
    const LIST_MODEL_UN = 'CONTRACT_FULFILLMENT_INFO_LIST';
    const FETCH_ONE_MODEL_UN = 'CONTRACT_FULFILLMENT_INFO_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new FulfillmentInfoRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new FulfillmentInfoMockAdapter()
        );
    }
}
