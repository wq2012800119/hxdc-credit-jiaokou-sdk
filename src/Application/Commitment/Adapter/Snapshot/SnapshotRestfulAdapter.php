<?php
namespace Sdk\Application\Commitment\Adapter\Snapshot;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Application\Commitment\Model\NullCommitmentSnapshot;
use Sdk\Application\Commitment\Translator\SnapshotRestfulTranslator;

class SnapshotRestfulAdapter extends CommonRestfulAdapter implements ISnapshotAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'SNAPSHOT_LIST'=>[
            'fields' => [
                'commitmentSnapshots'=>
                    'subjectName,identify,commitmentTypeId,CommitmentTypeOther,reason,commitmentDate,commitmentValidity,superviseStatus,examineStatus,organization,status,updateTime',//phpcs:ignore
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
            'application/commitmentSnapshots',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCommitmentSnapshot::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}
