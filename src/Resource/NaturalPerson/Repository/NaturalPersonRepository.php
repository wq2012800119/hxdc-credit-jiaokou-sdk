<?php
namespace Sdk\Resource\NaturalPerson\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\INaturalPersonAdapter;
use Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\NaturalPersonMockAdapter;
use Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\NaturalPersonRestfulAdapter;

class NaturalPersonRepository extends CommonRepository implements INaturalPersonAdapter
{
    const LIST_MODEL_UN = 'NATURAL_PERSON_LIST';
    const FETCH_ONE_MODEL_UN = 'NATURAL_PERSON_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new NaturalPersonRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new NaturalPersonMockAdapter()
        );
    }

    public function authorize(NaturalPerson $naturalPerson) : bool
    {
        return $this->getAdapter()->authorize($naturalPerson);
    }

    public function unAuthorize(NaturalPerson $naturalPerson) : bool
    {
        return $this->getAdapter()->unAuthorize($naturalPerson);
    }
}
