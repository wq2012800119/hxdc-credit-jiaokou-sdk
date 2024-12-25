<?php
namespace Sdk\Contract\Performance\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Contract\Performance\Model\Performance;
use Sdk\Contract\Performance\Model\NullPerformance;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class PerformanceTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullPerformance::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function objectToArray($performance, array $keys = array())
    {
        if (!$performance instanceof Performance) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'htbh',
                'htmc',
                'htlx',
                'xmbh',
                'cgr',
                'jfzttyshxydm',
                'cgrdz',
                'content',
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
                'warningStatus',
                'staff' => ['id', 'subjectName'],
                'organization' => ['id', 'name'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($performance->getId());
        }
        if (in_array('htbh', $keys)) {
            $expression['htbh'] = $performance->getHtbh();
        }
        if (in_array('htmc', $keys)) {
            $expression['htmc'] = $performance->getHtmc();
        }
        if (in_array('xmbh', $keys)) {
            $expression['xmbh'] = $performance->getXmbh();
        }
        if (in_array('cgr', $keys)) {
            $expression['cgr'] = $performance->getCgr();
        }
        if (in_array('jfzttyshxydm', $keys)) {
            $expression['jfzttyshxydm'] = $performance->getJfzttyshxydm();
        }
        if (in_array('cgrdz', $keys)) {
            $expression['cgrdz'] = $performance->getCgrdz();
        }
        if (in_array('gys', $keys)) {
            $expression['gys'] = $performance->getGys();
        }
        if (in_array('yftyshxydm', $keys)) {
            $expression['yftyshxydm'] = $performance->getYftyshxydm();
        }
        if (in_array('gysdz', $keys)) {
            $expression['gysdz'] = $performance->getGysdz();
        }
        if (in_array('gyslxfs', $keys)) {
            $expression['gyslxfs'] = $performance->getGyslxfs();
        }
        if (in_array('zybdmc', $keys)) {
            $expression['zybdmc'] = $performance->getZybdmc();
        }
        if (in_array('ggxh', $keys)) {
            $expression['ggxh'] = $performance->getGgxh();
        }
        if (in_array('zybdsl', $keys)) {
            $expression['zybdsl'] = $performance->getZybdsl();
        }
        if (in_array('zybddj', $keys)) {
            $expression['zybddj'] = $performance->getZybddj();
        }
        if (in_array('htje', $keys)) {
            $expression['htje'] = $performance->getHtje();
        }
        if (in_array('lyqx', $keys)) {
            $expression['lyqx'] = $performance->getLyqx();
            $expression['lyqxFormatConvert'] = date('Y-m-d', $performance->getLyqx());
        }
        if (in_array('qzdd', $keys)) {
            $expression['qzdd'] = $performance->getQzdd();
        }
        if (in_array('htqdrq', $keys)) {
            $expression['htqdrq'] = $performance->getHtqdrq();
            $expression['htqdrqFormatConvert'] = date('Y-m-d', $performance->getHtqdrq());
        }
        if (in_array('htggrq', $keys)) {
            $expression['htggrq'] = $performance->getHtggrq();
            $expression['htggrqFormatConvert'] = date('Y-m-d', $performance->getHtggrq());
        }
        if (in_array('qtbcsy', $keys)) {
            $expression['qtbcsy'] = $performance->getQtbcsy();
        }
        if (in_array('lyzt', $keys)) {
            $expression['lyzt'] = $performance->getLyzt();
        }
        if (in_array('ssqy', $keys)) {
            $expression['ssqy'] = $performance->getSsqy();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $performance->getStatus();
        }
        
        $expression = $this->typeObjectToArray($performance, $keys, $expression);
        $expression = $this->relationObjectToArray($performance, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $performance->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $performance->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $performance->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $performance->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Performance $performance, array $keys, array $expression) : array
    {
        if (in_array('htlx', $keys)) {
            $expression['htlx'] = $this->typeFormatConversion(
                $performance->getHtlx(),
                Performance::HTLX_CN
            );
        }
        if (in_array('cgfs', $keys)) {
            $expression['cgfs'] = $this->typeFormatConversion(
                $performance->getCgfs(),
                Performance::CGFS_CN
            );
        }
        if (in_array('sshy', $keys)) {
            $expression['sshy'] = $this->typeFormatConversion(
                $performance->getSshy(),
                Performance::SSHY_CN
            );
        }
        if (in_array('warningStatus', $keys)) {
            $expression['warningStatus'] = $this->typeFormatConversion(
                $performance->getWarningStatus(),
                Performance::WARNING_STATUS_CN
            );
        }

        return $expression;
    }

    protected function relationObjectToArray(Performance $performance, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $performance->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $performance->getOrganization(),
                $keys['organization']
            );
        }

        return $expression;
    }
}
