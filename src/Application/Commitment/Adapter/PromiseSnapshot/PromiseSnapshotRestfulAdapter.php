<?php
namespace Sdk\Application\Commitment\Adapter\PromiseSnapshot;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Application\Commitment\Model\NullPromiseSnapshot;
use Sdk\Application\Commitment\Translator\PromiseSnapshotRestfulTranslator;

class PromiseSnapshotRestfulAdapter extends CommonRestfulAdapter implements IPromiseSnapshotAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'SNAPSHOT_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization'
        ],
        'SNAPSHOT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new PromiseSnapshotRestfulTranslator(),
            'application/promiseSnapshots',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullPromiseSnapshot::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}
