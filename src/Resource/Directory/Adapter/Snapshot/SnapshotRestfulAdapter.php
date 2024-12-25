<?php
namespace Sdk\Resource\Directory\Adapter\Snapshot;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Resource\Directory\Model\NullDirectorySnapshot;
use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;

class SnapshotRestfulAdapter extends CommonRestfulAdapter implements ISnapshotAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'SNAPSHOT_LIST'=>[
            'fields' => [
                'directorySnapshots'=>
                    'name,identify,subjectCategory,infoCategory,organization,status,examineStatus,updateTime',
            ],
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
            new SnapshotRestfulTranslator(),
            'resourceDirectorySnapshots',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullDirectorySnapshot::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}
