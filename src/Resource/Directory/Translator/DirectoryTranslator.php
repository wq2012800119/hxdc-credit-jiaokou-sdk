<?php
namespace Sdk\Resource\Directory\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\NullDirectory;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Template\Translator\TemplateTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DirectoryTranslator implements ITranslator
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

    protected function getTemplateTranslator() : TemplateTranslator
    {
        return new TemplateTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullDirectory::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($directory, array $keys = array())
    {
        if (!$directory instanceof Directory) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'identify',
                'readOnly',
                'subjectCategory',
                'infoCategory',
                'description',
                'version',
                'versionDescription',
                'sourceUnits' => ['id', 'name'],
                'items',
                'organization' => ['id', 'name'],
                'template' => ['id', 'name', 'path'],
                'staff' => ['id', 'subjectName'],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($directory->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $directory->getName();
        }
        if (in_array('identify', $keys)) {
            $expression['identify'] = $directory->getIdentify();
        }
        if (in_array('readOnly', $keys)) {
            $expression['readOnly'] = marmot_encode($directory->getReadOnly());
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $directory->getDescription();
        }
        if (in_array('version', $keys)) {
            $expression['version'] = $directory->getVersion();
        }
        if (in_array('versionDescription', $keys)) {
            $expression['versionDescription'] = $directory->getVersionDescription();
        }
        $expression = $this->typeObjectToArray($directory, $keys, $expression);
        $expression = $this->relationObjectToArray($directory, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $directory->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $directory->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $directory->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $directory->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Directory $directory, array $keys, array $expression) : array
    {
        if (in_array('subjectCategory', $keys)) {
            $expression['subjectCategory'] = $this->subjectCategoryFormatConversion($directory->getSubjectCategory());
        }
        if (in_array('infoCategory', $keys)) {
            $expression['infoCategory'] = $this->typeFormatConversion(
                $directory->getInfoCategory(),
                Directory::INFO_CATEGORY_CN
            );
        }
        if (in_array('items', $keys)) {
            $expression['items'] = $this->itemsFormatConversion($directory->getItems());
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $directory->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $directory->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }

        return $expression;
    }

    protected function subjectCategoryFormatConversion($subjectCategory)
    {
        $categoryFormatConversion = array();
        foreach ($subjectCategory as $id) {
            $categoryFormatConversion[] = $this->typeFormatConversion($id, Directory::SUBJECT_CATEGORY_CN);
        }

        return $categoryFormatConversion;
    }

    protected function itemsFormatConversion($items)
    {
        foreach ($items as $key => $item) {
            $items[$key]['dataType'] = isset($item['dataType']) ? $this->typeFormatConversion(
                $item['dataType'],
                Directory::DATA_TYPE_CN
            ) : array();
            $items[$key]['required'] = isset($item['required']) ? $this->typeFormatConversion(
                $item['required'],
                Directory::REQUIRED_CN
            ) : array();
            $items[$key]['desensitization'] = isset($item['desensitization']) ? $this->typeFormatConversion(
                $item['desensitization'],
                Directory::DESENSITIZATION_CN
            ) : array();
            $items[$key]['publicationRange'] = isset($item['publicationRange']) ? $this->typeFormatConversion(
                $item['publicationRange'],
                Directory::PUBLICATION_RANGE_CN
            ) : array();
        }

        return $items;
    }

    protected function relationObjectToArray(Directory $directory, array $keys, array $expression) : array
    {
        if (isset($keys['sourceUnits'])) {
            $expression['sourceUnits'] = array();
            foreach ($directory->getSourceUnits() as $sourceUnit) {
                $expression['sourceUnits'][] = $this->getOrganizationTranslator()->objectToArray(
                    $sourceUnit,
                    $keys['sourceUnits']
                );
            }
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $directory->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['template'])) {
            $expression['template'] = $this->getTemplateTranslator()->objectToArray(
                $directory->getTemplate(),
                $keys['template']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $directory->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}
