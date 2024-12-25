<?php
namespace Sdk\Resource\Enterprise\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Adapter\Enterprise\IEnterpriseAdapter;
use Sdk\Resource\Enterprise\Adapter\Enterprise\EnterpriseMockAdapter;
use Sdk\Resource\Enterprise\Adapter\Enterprise\EnterpriseRestfulAdapter;

class EnterpriseRepository extends CommonRepository implements IEnterpriseAdapter
{
    const LIST_MODEL_UN = 'ENTERPRISE_LIST';
    const FETCH_ONE_MODEL_UN = 'ENTERPRISE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new EnterpriseRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new EnterpriseMockAdapter()
        );
    }

    public function authorize(Enterprise $enterprise) : bool
    {
        return $this->getAdapter()->authorize($enterprise);
    }

    public function unAuthorize(Enterprise $enterprise) : bool
    {
        return $this->getAdapter()->unAuthorize($enterprise);
    }

    public function fetchEnterpriseInteractionCount(Enterprise $enterprise) : Enterprise
    {
        return $this->getAdapter()->fetchEnterpriseInteractionCount($enterprise);
    }
}
