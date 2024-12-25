<?php
namespace Sdk\Application\ExportDataTask\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Application\ExportDataTask\Model\ExportDataTask;
use Sdk\Application\ExportDataTask\Model\NullExportDataTask;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class ExportDataTaskRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    public function arrayToObject(array $expression, $exportDataTask = null)
    {
        if (empty($expression)) {
            return NullExportDataTask::getInstance();
        }

        if ($exportDataTask == null) {
            $exportDataTask = new ExportDataTask();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $exportDataTask->setId($data['id']);
        }
        if (isset($attributes['total'])) {
            $exportDataTask->setTotal($attributes['total']);
        }
        if (isset($attributes['name'])) {
            $exportDataTask->setExportFileName($attributes['name']);
        }
        if (isset($attributes['size'])) {
            $exportDataTask->setSize($attributes['size']);
        }
        if (isset($attributes['offset'])) {
            $exportDataTask->setOffset($attributes['offset']);
        }
        if (isset($attributes['sort'])) {
            $exportDataTask->setSort($attributes['sort']);
        }
        if (isset($attributes['filter'])) {
            $exportDataTask->setFilter($attributes['filter']);
        }
        if (isset($attributes['updatedNum'])) {
            $exportDataTask->setUpdatedNum($attributes['updatedNum']);
        }
        if (isset($attributes['code'])) {
            $exportDataTask->setCode($attributes['code']);
        }
        if (isset($attributes['category'])) {
            $exportDataTask->setCategory($attributes['category']);
        }
        if (isset($attributes['status'])) {
            $exportDataTask->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $exportDataTask->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $exportDataTask->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $exportDataTask->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $exportDataTask->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $exportDataTask->setStaff($staff);
        }

        return $exportDataTask;
    }

    public function objectToArray($exportDataTask, array $keys = array())
    {
        if (!$exportDataTask instanceof ExportDataTask) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'size',
                'offset',
                'filter',
                'sort',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'exportTasks'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $exportDataTask->getId();
        }

        $attributes = array();

        if (in_array('filter', $keys)) {
            $attributes['filter'] = !empty($exportDataTask->getFilter()) ?
                                            $exportDataTask->getFilter() :
                                            new \ArrayObject;
        }
        if (in_array('sort', $keys)) {
            $attributes['sort'] = $exportDataTask->getSort();
        }
        if (in_array('size', $keys)) {
            $attributes['size'] = $exportDataTask->getSize();
        }
        if (in_array('offset', $keys)) {
            $attributes['offset'] = $exportDataTask->getOffset();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($exportDataTask->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}
