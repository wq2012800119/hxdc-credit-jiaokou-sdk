<?php
namespace Sdk\Contract\Performance\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Contract\Performance\Model\Performance;
use Sdk\Contract\Performance\Model\NullPerformance;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class PerformanceRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function arrayToObject(array $expression, $performance = null)
    {
        if (empty($expression)) {
            return NullPerformance::getInstance();
        }

        if ($performance == null) {
            $performance = new Performance();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $performance->setId($data['id']);
        }
        if (isset($attributes['htbh'])) {
            $performance->setHtbh($attributes['htbh']);
        }
        if (isset($attributes['htmc'])) {
            $performance->setHtmc($attributes['htmc']);
        }
        if (isset($attributes['htlx'])) {
            $performance->setHtlx($attributes['htlx']);
        }
        if (isset($attributes['xmbh'])) {
            $performance->setXmbh($attributes['xmbh']);
        }
        if (isset($attributes['cgr'])) {
            $performance->setCgr($attributes['cgr']);
        }
        if (isset($attributes['jfzttyshxydm'])) {
            $performance->setJfzttyshxydm($attributes['jfzttyshxydm']);
        }
        if (isset($attributes['cgrdz'])) {
            $performance->setCgrdz($attributes['cgrdz']);
        }
        if (isset($attributes['gys'])) {
            $performance->setGys($attributes['gys']);
        }
        if (isset($attributes['yftyshxydm'])) {
            $performance->setYftyshxydm($attributes['yftyshxydm']);
        }
        if (isset($attributes['gysdz'])) {
            $performance->setGysdz($attributes['gysdz']);
        }
        if (isset($attributes['gyslxfs'])) {
            $performance->setGyslxfs($attributes['gyslxfs']);
        }
        if (isset($attributes['zybdmc'])) {
            $performance->setZybdmc($attributes['zybdmc']);
        }
        if (isset($attributes['ggxh'])) {
            $performance->setGgxh($attributes['ggxh']);
        }
        if (isset($attributes['zybdsl'])) {
            $performance->setZybdsl($attributes['zybdsl']);
        }
        if (isset($attributes['zybddj'])) {
            $performance->setZybddj($attributes['zybddj']);
        }
        if (isset($attributes['htje'])) {
            $performance->setHtje($attributes['htje']);
        }
        if (isset($attributes['lyqx'])) {
            $performance->setLyqx($attributes['lyqx']);
        }
        if (isset($attributes['qzdd'])) {
            $performance->setQzdd($attributes['qzdd']);
        }
        if (isset($attributes['cgfs'])) {
            $performance->setCgfs($attributes['cgfs']);
        }
        if (isset($attributes['htqdrq'])) {
            $performance->setHtqdrq($attributes['htqdrq']);
        }
        if (isset($attributes['htggrq'])) {
            $performance->setHtggrq($attributes['htggrq']);
        }
        if (isset($attributes['qtbcsy'])) {
            $performance->setQtbcsy($attributes['qtbcsy']);
        }
        if (isset($attributes['lyzt'])) {
            $performance->setLyzt($attributes['lyzt']);
        }
        if (isset($attributes['ssqy'])) {
            $performance->setSsqy($attributes['ssqy']);
        }
        if (isset($attributes['sshy'])) {
            $performance->setSshy($attributes['sshy']);
        }
        if (isset($attributes['warningStatus'])) {
            $performance->setWarningStatus($attributes['warningStatus']);
        }
        if (isset($attributes['status'])) {
            $performance->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $performance->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $performance->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $performance->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $performance->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $performance->setStaff($staff);
        }
        
        return $performance;
    }

    /**
     * @todo
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

        $expression = array(
            'data' => array(
                'type' => 'contractPerformances'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $performance->getId();
        }

        $attributes = array();

        if (in_array('htbh', $keys)) {
            $attributes['htbh'] = $performance->getHtbh();
        }
        if (in_array('htmc', $keys)) {
            $attributes['htmc'] = $performance->getHtmc();
        }
        if (in_array('htlx', $keys)) {
            $attributes['htlx'] = $performance->getHtlx();
        }
        if (in_array('xmbh', $keys)) {
            $attributes['xmbh'] = $performance->getXmbh();
        }
        if (in_array('cgr', $keys)) {
            $attributes['cgr'] = $performance->getCgr();
        }
        if (in_array('jfzttyshxydm', $keys)) {
            $attributes['jfzttyshxydm'] = $performance->getJfzttyshxydm();
        }
        if (in_array('cgrdz', $keys)) {
            $attributes['cgrdz'] = $performance->getCgrdz();
        }
        if (in_array('gys', $keys)) {
            $attributes['gys'] = $performance->getGys();
        }
        if (in_array('yftyshxydm', $keys)) {
            $attributes['yftyshxydm'] = $performance->getYftyshxydm();
        }
        if (in_array('gysdz', $keys)) {
            $attributes['gysdz'] = $performance->getGysdz();
        }
        if (in_array('gyslxfs', $keys)) {
            $attributes['gyslxfs'] = $performance->getGyslxfs();
        }
        if (in_array('zybdmc', $keys)) {
            $attributes['zybdmc'] = $performance->getZybdmc();
        }
        if (in_array('ggxh', $keys)) {
            $attributes['ggxh'] = $performance->getGgxh();
        }
        if (in_array('zybdsl', $keys)) {
            $attributes['zybdsl'] = $performance->getZybdsl();
        }
        if (in_array('zybddj', $keys)) {
            $attributes['zybddj'] = $performance->getZybddj();
        }
        if (in_array('htje', $keys)) {
            $attributes['htje'] = $performance->getHtje();
        }
        if (in_array('lyqx', $keys)) {
            $attributes['lyqx'] = $performance->getLyqx();
        }
        if (in_array('qzdd', $keys)) {
            $attributes['qzdd'] = $performance->getQzdd();
        }
        if (in_array('cgfs', $keys)) {
            $attributes['cgfs'] = $performance->getCgfs();
        }
        if (in_array('htqdrq', $keys)) {
            $attributes['htqdrq'] = $performance->getHtqdrq();
        }
        if (in_array('htggrq', $keys)) {
            $attributes['htggrq'] = $performance->getHtggrq();
        }
        if (in_array('qtbcsy', $keys)) {
            $attributes['qtbcsy'] = $performance->getQtbcsy();
        }
        if (in_array('lyzt', $keys)) {
            $attributes['lyzt'] = $performance->getLyzt();
        }
        if (in_array('ssqy', $keys)) {
            $attributes['ssqy'] = $performance->getSsqy();
        }
        if (in_array('sshy', $keys)) {
            $attributes['sshy'] = $performance->getSshy();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($performance->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}
