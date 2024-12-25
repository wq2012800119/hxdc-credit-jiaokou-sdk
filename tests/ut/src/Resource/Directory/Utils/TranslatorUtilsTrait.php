<?php
namespace Sdk\Resource\Directory\Utils;

use Sdk\Resource\Directory\Model\Template;
use Sdk\Resource\Directory\Model\Directory;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Directory $directory, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $directory->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $directory->getName());
        }
        if (isset($attributes['identify'])) {
            $this->assertEquals($attributes['identify'], $directory->getIdentify());
        }
        if (isset($attributes['description'])) {
            $this->assertEquals($attributes['description'], $directory->getDescription());
        }
        if (isset($attributes['readOnly'])) {
            $this->assertEquals($attributes['readOnly'], $directory->getReadOnly());
        }
        if (isset($attributes['infoCategory'])) {
            $this->assertEquals($attributes['infoCategory'], $directory->getInfoCategory());
        }
        if (isset($attributes['versionDescription'])) {
            $this->assertEquals($attributes['versionDescription'], $directory->getVersionDescription());
        }
        if (isset($attributes['versionNumber'])) {
            $this->assertEquals($attributes['versionNumber'], $directory->getVersion());
        }
        if (isset($attributes['examineStatus'])) {
            $this->assertEquals($attributes['examineStatus'], $directory->getExamineStatus());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $directory->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $directory->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $directory->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $directory->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['sourceUnits']['data'])) {
            $sourceUnits = $relationships['sourceUnits']['data'];
            foreach ($sourceUnits as $sourceUnit) {
                $this->assertEquals($sourceUnit['type'], 'organizations');
                $this->assertEquals($sourceUnit['id'], $directory->getSourceUnits()[0]->getId());
            }
        }
        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $directory->getStaff()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Directory $directory)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($directory->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $directory->getName());
        }
        if (isset($expression['identify'])) {
            $this->assertEquals($expression['identify'], $directory->getIdentify());
        }
        if (isset($expression['readOnly'])) {
            $this->assertEquals($expression['readOnly'], marmot_encode($directory->getReadOnly()));
        }
        if (isset($expression['description'])) {
            $this->assertEquals($expression['description'], $directory->getDescription());
        }
        if (isset($expression['version'])) {
            $this->assertEquals($expression['version'], $directory->getVersion());
        }
        if (isset($expression['versionDescription'])) {
            $this->assertEquals($expression['versionDescription'], $directory->getVersionDescription());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $directory->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $directory->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $directory->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $directory->getUpdateTime())
            );
        }
    }

    public function compareTemplateRestfulTranslatorEquals(Template $template, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $template->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $template->getName());
        }
        if (isset($attributes['path'])) {
            $this->assertEquals($attributes['path'], $template->getPath());
        }
    }

    public function compareTemplateTranslatorEquals(array $expression, Template $template)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($template->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $template->getName());
        }
        if (isset($expression['path'])) {
            $this->assertEquals($expression['path'], $template->getPath());
        }
    }
}
