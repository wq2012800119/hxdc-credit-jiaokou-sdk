<?php
namespace Sdk\Resource\Directory\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\NullDirectory;

use Sdk\Template\Translator\TemplateRestfulTranslator;
use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DirectoryRestfulTranslator implements IRestfulTranslator
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

    protected function getTemplateRestfulTranslator() : TemplateRestfulTranslator
    {
        return new TemplateRestfulTranslator();
    }

    public function arrayToObject(array $expression, $directory = null)
    {
        if (empty($expression)) {
            return NullDirectory::getInstance();
        }

        if ($directory == null) {
            $directory = new Directory();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $directory->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $directory->setName($attributes['name']);
        }
        if (isset($attributes['identify'])) {
            $directory->setIdentify($attributes['identify']);
        }
        if (isset($attributes['readOnly'])) {
            $directory->setReadOnly($attributes['readOnly']);
        }
        if (isset($attributes['subjectCategory'])) {
            $subjectCategory = $this->subjectCategorySplit($attributes['subjectCategory']);
            $directory->setSubjectCategory($subjectCategory);
        }
        if (isset($attributes['infoCategory'])) {
            $directory->setInfoCategory($attributes['infoCategory']);
        }
        if (isset($attributes['description'])) {
            $directory->setDescription($attributes['description']);
        }
        if (isset($attributes['versionNumber'])) {
            $directory->setVersion($attributes['versionNumber']);
        }
        if (isset($attributes['versionDescription'])) {
            $directory->setVersionDescription($attributes['versionDescription']);
        }
        if (isset($attributes['items'])) {
            $directory->setItems($attributes['items']);
        }
        if (isset($attributes['examineStatus'])) {
            $directory->setExamineStatus($attributes['examineStatus']);
        }
        if (isset($attributes['status'])) {
            $directory->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $directory->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $directory->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $directory->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $directory->setOrganization($organization);
        }

        if (isset($relationships['template'])) {
            $templateArray = $this->relationshipFill($relationships['template'], $included);
            $template = $this->getTemplateRestfulTranslator()->arrayToObject($templateArray);
            $directory->setTemplate($template);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $directory->setStaff($staff);
        }

        if (isset($relationships['sourceUnits'])) {
            $sourceUnits = $this->relationshipsFill($relationships['sourceUnits'], $included);

            foreach ($sourceUnits as $sourceUnitArray) {
                $sourceUnit = $this->getOrganizationRestfulTranslator()->arrayToObject($sourceUnitArray);
                $directory->addSourceUnit($sourceUnit);
            }
        }
        
        return $directory;
    }

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
                'subjectCategory',
                'infoCategory',
                'description',
                'versionDescription',
                'sourceUnits',
                'items',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'directories'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $directory->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $directory->getName();
        }
        if (in_array('identify', $keys)) {
            $attributes['identify'] = $directory->getIdentify();
        }
        if (in_array('subjectCategory', $keys)) {
            $subjectCategory = $this->subjectCategoryMerge($directory->getSubjectCategory());
            $attributes['subjectCategory'] = $subjectCategory;
        }
        if (in_array('infoCategory', $keys)) {
            $attributes['infoCategory'] = $directory->getInfoCategory();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $directory->getDescription();
        }
        if (in_array('versionDescription', $keys)) {
            $attributes['versionDescription'] = $directory->getVersionDescription();
        }
        if (in_array('items', $keys)) {
            $attributes['items'] = $this->itemsFormatConversion($directory->getItems());
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($directory->getStaff()->getId())
            );
        }
        
        if (in_array('sourceUnits', $keys)) {
            $sourceUnitsRelationships = array();

            foreach ($directory->getSourceUnits() as $sourceUnit) {
                $sourceUnitsRelationships[] = array(
                    'type' => 'organizations',
                    'id' => strval($sourceUnit->getId())
                );
            }

            if (!empty($sourceUnitsRelationships)) {
                $expression['data']['relationships']['sourceUnits']['data'] = $sourceUnitsRelationships;
            }
        }

        return $expression;
    }

    protected function itemsFormatConversion(array $items) : array
    {
        foreach ($items as $key => $item) {
            $items[$key]['dataType'] = intval($item['dataType']);
            $items[$key]['dataLength'] = intval($item['dataLength']);
            $items[$key]['required'] = intval($item['required']);
            $items[$key]['desensitization'] = intval($item['desensitization']);
            $items[$key]['publicationRange'] = intval($item['publicationRange']);
            if ($item['desensitization'] == Directory::DESENSITIZATION['NO']) {
                $items[$key]['desensitizationRule'] = [0, 0];
            }
            if ($item['desensitization'] != Directory::DESENSITIZATION['NO']) {
                $desensitizationRule = array();

                foreach ($item['desensitizationRule'] as $value) {
                    $desensitizationRule[] = intval($value);
                }
                $items[$key]['desensitizationRule'] = $desensitizationRule;
            }
        }

        return $items;
    }

    protected function subjectCategoryMerge(array $subjectCategoryArray) : int
    {
        $subjectCategory = 0;

        foreach ($subjectCategoryArray as $value) {
            $subjectCategory += $value;
        }

        return $subjectCategory;
    }

    protected function subjectCategorySplit(int $subjectCategory) : array
    {
        $subjectCategoryArray = array();

        foreach (Directory::SUBJECT_CATEGORY as $value) {
            if (($value & $subjectCategory) == $value) {
                $subjectCategoryArray[] = $value;
            }
        }

        return $subjectCategoryArray;
    }
}
