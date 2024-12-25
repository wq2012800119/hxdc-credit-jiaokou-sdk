<?php
namespace Sdk\Contract\Performance\Adapter\Performance;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Contract\Performance\Model\Performance;
use Sdk\Contract\Performance\Model\NullPerformance;
use Sdk\Contract\Performance\Translator\PerformanceRestfulTranslator;

class PerformanceRestfulAdapter extends CommonRestfulAdapter implements IPerformanceAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'htbm' => CONTRACT_PERFORMANCE_HTBH_FORMAT_INCORRECT,
            'htmc' => CONTRACT_PERFORMANCE_HTMC_FORMAT_INCORRECT,
            'htlx' => CONTRACT_PERFORMANCE_HTLX_FORMAT_INCORRECT,
            'xmbh' => CONTRACT_PERFORMANCE_XMBH_FORMAT_INCORRECT,
            'cgr' => CONTRACT_PERFORMANCE_CGR_FORMAT_INCORRECT,
            'jfzttyshxydm' => CONTRACT_PERFORMANCE_JFZTTYSHXYDM_FORMAT_INCORRECT,
            'cgrdz' => CONTRACT_PERFORMANCE_CGRDZ_FORMAT_INCORRECT,
            'gys' => CONTRACT_PERFORMANCE_GYS_FORMAT_INCORRECT,
            'yftyshxydm' => CONTRACT_PERFORMANCE_YFTYSHXYDM_FORMAT_INCORRECT,
            'gysdz' => CONTRACT_PERFORMANCE_GYSDZ_FORMAT_INCORRECT,
            'gyslxfs' => CONTRACT_PERFORMANCE_GYSLXFS_FORMAT_INCORRECT,
            'zybdmc' => CONTRACT_PERFORMANCE_ZYBDMC_FORMAT_INCORRECT,
            'ggxh' => CONTRACT_PERFORMANCE_GGXH_FORMAT_INCORRECT,
            'zybdsl' => CONTRACT_PERFORMANCE_ZYBDSL_FORMAT_INCORRECT,
            'zybddj' => CONTRACT_PERFORMANCE_ZYBDDJ_FORMAT_INCORRECT,
            'htje' => CONTRACT_PERFORMANCE_HTJE_FORMAT_INCORRECT,
            'lyqx' => CONTRACT_PERFORMANCE_LYQX_FORMAT_INCORRECT,
            'qzdd' => CONTRACT_PERFORMANCE_QZDD_FORMAT_INCORRECT,
            'cgfs' => CONTRACT_PERFORMANCE_CGFS_FORMAT_INCORRECT,
            'htqdrq' => CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT,
            'htggrq' => CONTRACT_PERFORMANCE_HTGGRQ_FORMAT_INCORRECT,
            'qtbcsy' => CONTRACT_PERFORMANCE_QTBCSY_FORMAT_INCORRECT,
            'lyzt' => CONTRACT_PERFORMANCE_LYZT_FORMAT_INCORRECT,
            'ssqy' => CONTRACT_PERFORMANCE_SSQY_FORMAT_INCORRECT,
            'sshy' => CONTRACT_PERFORMANCE_SSHY_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'contractPerformance' =>  CONTRACT_PERFORMANCE_EXISTS
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'CONTRACT_PERFORMANCE_LIST'=>[
            'fields' => [
                'performances'=>
                    'htbh,htmc,htlx,cgr,lyzt,warningStatus,organization,status,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'CONTRACT_PERFORMANCE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new PerformanceRestfulTranslator(),
            'contract/performances',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullPerformance::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    protected function insertTranslatorKeys() : array
    {
        return array(
            'htbh',
            'htmc',
            'htlx',
            'xmbh',
            'cgr',
            'jfzttyshxydm',
            'cgrdz',
            'gys',
            'yftyshxydm',
            'gysdz',
            'gyslxfs',
            'zybdmc',
            'ggxh',
            'zybdsl',
            'zybddj',
            'htje',
            'lyqx',
            'qzdd',
            'cgfs',
            'htqdrq',
            'htggrq',
            'qtbcsy',
            'lyzt',
            'ssqy',
            'sshy',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return [];
    }

    public function ignoreWarning(Performance $performance) : bool
    {
        $this->patch(
            $this->getResource().'/'.$performance->getId().'/ignoreWarning'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($performance);
            return true;
        }

        return false;
    }
}
