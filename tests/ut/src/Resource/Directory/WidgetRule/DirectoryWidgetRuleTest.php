<?php
namespace Sdk\Resource\Directory\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DirectoryWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectoryWidgetRuleMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //name
    /**
     * @dataProvider additionProviderName
     */
    public function testName($parameter, $expected)
    {
        $result = $this->stub->name($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_NAME_FORMAT_INCORRECT, Core::getLastError()->getId());
    }
    //itemName
    /**
     * @dataProvider additionProviderName
     */
    public function testItemName($parameter, $expected)
    {
        $result = $this->stub->itemNamePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_NAME_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderName()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(DirectoryWidgetRule::NAME_MIN_LENGTH), true),
            array($this->randomChar(DirectoryWidgetRule::NAME_MIN_LENGTH-1), false),
            array($this->randomChar(DirectoryWidgetRule::NAME_MAX_LENGTH), true),
            array($this->randomChar(DirectoryWidgetRule::NAME_MAX_LENGTH+1), false)
        );
    }
    
    //identify
    /**
     * @dataProvider additionProviderIdentify
     */
    public function testIdentify($parameter, $expected)
    {
        $result = $this->stub->identify($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_IDENTIFY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }
    //itemIdentify
    /**
     * @dataProvider additionProviderIdentify
     */
    public function testItemIdentify($parameter, $expected)
    {
        $result = $this->stub->itemIdentifyPublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_IDENTIFY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderIdentify()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array('XZXK', true),
            array('_A_1', false),
            array('A_A_', false)
        );
    }

    //subjectCategory
    /**
     * @dataProvider additionProviderSubjectCategory
     */
    public function testSubjectCategory($parameter, $expected)
    {
        $result = $this->stub->subjectCategory($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSubjectCategory()
    {
        return array(
            array('', false),
            array(array(), false),
            array(array(9999), false),
            array(array(Directory::SUBJECT_CATEGORY['FRJFFRZZ']), true)
        );
    }

    //infoCategory
    /**
     * @dataProvider additionProviderInfoCategory
     */
    public function testInfoCategory($parameter, $expected)
    {
        $result = $this->stub->infoCategory($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_INFO_CATEGORY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderInfoCategory()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Directory::INFO_CATEGORY_OPTIONAL['CSSX'], true)
        );
    }

    //sourceUnits
    /**
     * @dataProvider additionProviderSourceUnits
     */
    public function testSourceUnits($parameter, $expected)
    {
        $result = $this->stub->sourceUnits($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSourceUnits()
    {
        return array(
            array('', false),
            array(array(), false),
            array(array(9999), true),
            array(array('sourceUnit'), false)
        );
    }

    public function testItems()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRule::class)
                           ->setMethods([
                               'itemsTypeFormatValidate',
                               'itemsCountFormatValidate',
                               'itemsRequiredItemValidate',
                               'itemsFormatValidate'
                            ])->getMock();

        $items = $subjectCategory = array('items');

        $stub->expects($this->once())->method('itemsTypeFormatValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemsCountFormatValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method(
            'itemsRequiredItemValidate'
        )->with($items, $subjectCategory)->willReturn(true);
        $stub->expects($this->once())->method('itemsFormatValidate')->with($items)->willReturn(true);

        $result = $stub->items($items, $subjectCategory);
        $this->assertTrue($result);
    }

    //itemsTypeFormatValidate
    /**
     * @dataProvider additionProviderItemsTypeFormatValidate
     */
    public function testItemsTypeFormatValidate($parameter, $expected)
    {
        $result = $this->stub->itemsTypeFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemsTypeFormatValidate()
    {
        return array(
            array('', false),
            array(array(), false),
            array(array(9999), true)
        );
    }

    //itemsCountFormatValidate
    /**
     * @dataProvider additionProviderItemsCountFormatValidate
     */
    public function testItemsCountFormatValidate($parameter, $expected)
    {
        $result = $this->stub->itemsCountFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_COUNT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemsCountFormatValidate()
    {
        return array(
            array(array(9999), true),
            array(array_fill(0, DirectoryWidgetRule::ITEMS_MAX_COUNT+1, 'itemsCount'), false)
        );
    }

    //itemsRequiredItemValidate
    /**
     * @dataProvider additionProviderItemsRequiredItemValidate
     */
    public function testItemsRequiredItemValidate($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->itemsRequiredItemValidatePublic($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemsRequiredItemValidate()
    {
        return array(
            array(array(1), '', false),
            array(array(array('identify' => 'ZTMC')), array(Directory::SUBJECT_CATEGORY['ZRR']), false),
            array(array(
                array('identify' => 'ZTMC'),
                array('identify' => 'ZJHM')
            ), array(Directory::SUBJECT_CATEGORY['ZRR']), true),
            array(array(
                array('identify' => 'ZTMC'),
                array('identify' => 'ZJHM')
            ), array(Directory::SUBJECT_CATEGORY['GTGSH']), false),
            array(array(
                array('identify' => 'ZTMC'),
                array('identify' => 'TYSHXYDM')
            ), array(Directory::SUBJECT_CATEGORY['GTGSH']), true)
        );
    }

    public function testItemsFormatValidate()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemFormatValidate'
                            ])->getMock();

        $items = array('items');
        $stub->expects($this->once())->method('itemFormatValidate')->willReturn(true);

        $result = $stub->itemsFormatValidatePublic($items);
        $this->assertTrue($result);
    }

    public function testItemsFormatValidateFalse()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemFormatValidate'
                            ])->getMock();

        $items = array('items');
        $stub->expects($this->once())->method('itemFormatValidate')->willReturn(false);

        $result = $stub->itemsFormatValidatePublic($items);
        $this->assertFalse($result);
    }

    public function testItemFormatValidate()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemKeyValidate',
                               'itemNameValidate',
                               'itemIdentifyValidate',
                               'itemDataTypeValidate',
                               'itemDataLengthValidate',
                               'itemOptionalRangeValidate',
                               'itemRequiredValidate',
                               'itemDesensitizationValidate',
                               'itemDesensitizationRuleValidate',
                               'itemPublicationRangeValidate',
                               'itemRemarksValidate'
                            ])->getMock();

        $items = $item =array('items');
        $stub->expects($this->once())->method('itemKeyValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemNameValidate')->with($items, $item)->willReturn(true);
        $stub->expects($this->once())->method('itemIdentifyValidate')->with($items, $item)->willReturn(true);
        $stub->expects($this->once())->method('itemDataTypeValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemDataLengthValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemOptionalRangeValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemRequiredValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemDesensitizationValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemDesensitizationRuleValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemPublicationRangeValidate')->with($items)->willReturn(true);
        $stub->expects($this->once())->method('itemRemarksValidate')->with($items)->willReturn(true);

        $result = $stub->itemFormatValidatePublic($items, $item);
        $this->assertTrue($result);
    }

    //itemKeyValidate
    /**
     * @dataProvider additionProviderItemKeyValidate
     */
    public function testItemKeyValidate($parameter, $expected)
    {
        $result = $this->stub->itemKeyValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemKeyValidate()
    {
        $item = array();

        foreach (DirectoryWidgetRule::ITEM_KEY as $value) {
            $item[$value] = $value;
        }

        return array(
            array('', false),
            array(array(), false),
            array(array('aa'), false),
            array($item, true)
        );
    }

    //itemNameValidate
    public function testItemNameValidateFalse()
    {
        $items = $item = array('items');

        $result = $this->stub->itemNameValidatePublic($items, $item);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testItemNameValidate()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemName',
                               'itemNameUnique'
                            ])->getMock();

        $items = $item = array('name' => 'name');
        $stub->expects($this->once())->method('itemName')->with($item['name'])->willReturn(true);
        $stub->expects($this->once())->method('itemNameUnique')->with($items)->willReturn(true);

        $result = $stub->itemNameValidatePublic($items, $item);
        $this->assertTrue($result);
    }

    //itemNameUnique
    public function testItemNameUniqueFalse()
    {
        $items = array(array('name' => 'ZTMC'), array('name' => 'ZTMC'));

        $result = $this->stub->itemNameUniquePublic($items);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_NAME_EXISTS, Core::getLastError()->getId());
    }

    public function testItemNameUnique()
    {
        $items = array(array('name' => 'ZTMC'), array('name' => 'ZJHM'));

        $result = $this->stub->itemNameUniquePublic($items);
        
        $this->assertTrue($result);
    }

    //itemIdentifyValidate
    public function testItemIdentifyValidateFalse()
    {
        $items = $item = array('items');

        $result = $this->stub->itemIdentifyValidatePublic($items, $item);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testItemIdentifyValidate()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemIdentify',
                               'itemIdentifyUnique'
                            ])->getMock();

        $items = $item = array('identify' => 'identify');
        $stub->expects($this->once())->method('itemIdentify')->with($item['identify'])->willReturn(true);
        $stub->expects($this->once())->method('itemIdentifyUnique')->with($items)->willReturn(true);

        $result = $stub->itemIdentifyValidatePublic($items, $item);
        $this->assertTrue($result);
    }

    //itemIdentifyUnique
    public function testItemIdentifyUniqueFalse()
    {
        $items = array(array('identify' => 'ZTMC'), array('identify' => 'ZTMC'));

        $result = $this->stub->itemIdentifyUniquePublic($items);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_IDENTIFY_EXISTS, Core::getLastError()->getId());
    }

    public function testItemIdentifyUnique()
    {
        $items = array(array('identify' => 'ZTMC'), array('identify' => 'ZJHM'));

        $result = $this->stub->itemIdentifyUniquePublic($items);
        
        $this->assertTrue($result);
    }

    //itemDataTypeValidate
    /**
     * @dataProvider additionProviderItemDataTypeValidate
     */
    public function testItemDataTypeValidate($parameter, $expected)
    {
        $result = $this->stub->itemDataTypeValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DATA_TYPE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemDataTypeValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('dataType' => 'dataType'), false),
            array(array('dataType' => Directory::DATA_TYPE['ZFX']), true)
        );
    }

    //itemDataLengthValidate
    public function testItemDataLengthValidateFalse()
    {
        $item = array('identify' => 'ZTMC');

        $result = $this->stub->itemDataLengthValidatePublic($item);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testItemDataLengthValidateTrueEmpty()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemDataLengthValidateEmpty'
                            ])->getMock();

        $item = array('dataType' => Directory::DATA_TYPE['RQX'], 'dataLength' => '');

        $stub->expects($this->once())->method(
            'itemDataLengthValidateEmpty'
        )->with($item['dataLength'])->willReturn(true);

        $result = $stub->itemDataLengthValidatePublic($item);
        $this->assertTrue($result);
    }

    public function testItemDataLengthValidateTrueNotEmpty()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemDataLengthValidateNotEmpty'
                            ])->getMock();

        $item = array('dataType' => Directory::DATA_TYPE['ZFX'], 'dataLength' => 1);

        $stub->expects($this->once())->method(
            'itemDataLengthValidateNotEmpty'
        )->with($item['dataLength'])->willReturn(true);

        $result = $stub->itemDataLengthValidatePublic($item);
        $this->assertTrue($result);
    }

    //itemDataLengthValidateEmpty
    /**
     * @dataProvider additionProviderItemDataLengthValidateEmpty
     */
    public function testItemDataLengthValidateEmpty($parameter, $expected)
    {
        $result = $this->stub->itemDataLengthValidateEmptyPublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemDataLengthValidateEmpty()
    {
        return array(
            array('', true),
            array(array(1), false)
        );
    }

    //itemDataLengthValidateNotEmpty
    /**
     * @dataProvider additionProviderItemDataLengthValidateNotEmpty
     */
    public function testItemDataLengthValidateNotEmpty($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->itemDataLengthValidateNotEmptyPublic($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemDataLengthValidateNotEmpty()
    {
        return array(
            array(
                Directory::DATA_TYPE['ZFX'], DirectoryWidgetRule::DATA_LENGTH_MIN_LENGTH_ZFX,
                true
            ),
            array(
                Directory::DATA_TYPE['ZFX'], DirectoryWidgetRule::DATA_LENGTH_MIN_LENGTH_ZFX-1,
                false
            ),
            array(
                Directory::DATA_TYPE['ZFX'], DirectoryWidgetRule::DATA_LENGTH_MAX_LENGTH_ZFX,
                true
            ),
            array(
                Directory::DATA_TYPE['ZFX'], DirectoryWidgetRule::DATA_LENGTH_MAX_LENGTH_ZFX+1,
                false
            ),
            array(
                Directory::DATA_TYPE['ZSX'], DirectoryWidgetRule::DATA_LENGTH_MIN_LENGTH_ZSX,
                true
            ),
            array(
                Directory::DATA_TYPE['ZSX'], DirectoryWidgetRule::DATA_LENGTH_MIN_LENGTH_ZSX-1,
                false
            ),
            array(
                Directory::DATA_TYPE['ZSX'], DirectoryWidgetRule::DATA_LENGTH_MAX_LENGTH_ZSX,
                true
            ),
            array(
                Directory::DATA_TYPE['ZSX'], DirectoryWidgetRule::DATA_LENGTH_MAX_LENGTH_ZSX+1,
                false
            ),
            array(
                Directory::DATA_TYPE['MJX'], DirectoryWidgetRule::DATA_LENGTH_MIN_LENGTH_MJX_JHX,
                true
            ),
            array(
                Directory::DATA_TYPE['MJX'], DirectoryWidgetRule::DATA_LENGTH_MIN_LENGTH_MJX_JHX-1,
                false
            ),
            array(
                Directory::DATA_TYPE['MJX'], DirectoryWidgetRule::DATA_LENGTH_MAX_LENGTH_MJX_JHX,
                true
            ),
            array(
                Directory::DATA_TYPE['MJX'], DirectoryWidgetRule::DATA_LENGTH_MAX_LENGTH_MJX_JHX+1,
                false
            ),
        );
    }

    //itemOptionalRangeValidate
    public function testItemOptionalRangeValidateFalse()
    {
        $item = array('identify' => 'ZTMC');

        $result = $this->stub->itemOptionalRangeValidatePublic($item);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testItemOptionalRangeValidateTrueEmpty()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemOptionalRangeValidateEmpty'
                            ])->getMock();

        $item = array('dataType' => Directory::DATA_TYPE['RQX'], 'optionalRange' => '');

        $stub->expects($this->once())->method(
            'itemOptionalRangeValidateEmpty'
        )->with($item['optionalRange'])->willReturn(true);

        $result = $stub->itemOptionalRangeValidatePublic($item);
        $this->assertTrue($result);
    }

    public function testItemOptionalRangeValidateTrueNotEmpty()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemOptionalRangeValidateNotEmpty'
                            ])->getMock();

        $item = array('dataType' => Directory::DATA_TYPE['MJX'], 'optionalRange' => 'optionalRange');

        $stub->expects($this->once())->method(
            'itemOptionalRangeValidateNotEmpty'
        )->with($item['optionalRange'])->willReturn(true);

        $result = $stub->itemOptionalRangeValidatePublic($item);
        $this->assertTrue($result);
    }

    //itemOptionalRangeValidateEmpty
    /**
     * @dataProvider additionProviderItemOptionalRangeValidateEmpty
     */
    public function testItemOptionalRangeValidateEmpty($parameter, $expected)
    {
        $result = $this->stub->itemOptionalRangeValidateEmptyPublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemOptionalRangeValidateEmpty()
    {
        return array(
            array('', true),
            array(array(1), false)
        );
    }

    //itemOptionalRangeValidateNotEmpty
    /**
     * @dataProvider additionProviderItemOptionalRangeValidateNotEmpty
     */
    public function testItemOptionalRangeValidateNotEmpty($parameter, $expected)
    {
        $result = $this->stub->itemOptionalRangeValidateNotEmptyPublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemOptionalRangeValidateNotEmpty()
    {
        return array(
            array('', false),
            array($this->randomChar(DirectoryWidgetRule::OPTIONAL_RANGE_MIN_LENGTH), true),
            array($this->randomChar(DirectoryWidgetRule::OPTIONAL_RANGE_MIN_LENGTH-1), false),
            array($this->randomChar(DirectoryWidgetRule::OPTIONAL_RANGE_MAX_LENGTH), true),
            array($this->randomChar(DirectoryWidgetRule::OPTIONAL_RANGE_MAX_LENGTH+1), false)
        );
    }

    //itemRequiredValidate
    /**
     * @dataProvider additionProviderItemRequiredValidate
     */
    public function testItemRequiredValidate($parameter, $expected)
    {
        $result = $this->stub->itemRequiredValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemRequiredValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('required' => 'required'), false),
            array(array('required' => Directory::REQUIRED['NO']), true)
        );
    }

    //itemDesensitizationValidate
    /**
     * @dataProvider additionProviderItemDesensitizationValidate
     */
    public function testItemDesensitizationValidate($parameter, $expected)
    {
        $result = $this->stub->itemDesensitizationValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemDesensitizationValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('desensitization' => 'desensitization'), false),
            array(array('desensitization' => Directory::DESENSITIZATION['NO']), true)
        );
    }

    //itemPublicationRangeValidate
    /**
     * @dataProvider additionProviderItemPublicationRangeValidate
     */
    public function testItemPublicationRangeValidate($parameter, $expected)
    {
        $result = $this->stub->itemPublicationRangeValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemPublicationRangeValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('publicationRange' => 'publicationRange'), false),
            array(array('publicationRange' => Directory::PUBLICATION_RANGE['SHGK']), true)
        );
    }

    //itemRemarksValidate
    /**
     * @dataProvider additionProviderItemRemarksValidate
     */
    public function testItemRemarksValidate($parameter, $expected)
    {
        $result = $this->stub->itemRemarksValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemRemarksValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(
                array('remarks' => $this->randomChar(DirectoryWidgetRule::REMARKS_MIN_LENGTH)),
                true
            ),
            array(array(
                'remarks' => $this->randomChar(DirectoryWidgetRule::REMARKS_MAX_LENGTH)),
                true
            ),
            array(array('remarks' => $this->randomChar(DirectoryWidgetRule::REMARKS_MAX_LENGTH+1)),
                false
            )
        );
    }

    //itemDesensitizationRuleValidate
    public function testItemDesensitizationRuleValidateFalse()
    {
        $item = array('identify' => 'ZTMC');

        $result = $this->stub->itemDesensitizationRuleValidatePublic($item);
        
        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testItemDesensitizationRuleValidateTrueEmpty()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemDesensitizationRuleValidateNo'
                            ])->getMock();

        $item = array(
            'desensitization' => Directory::DESENSITIZATION['NO'],
            'desensitizationRule' => [],
            'dataLength' => 5
        );

        $stub->expects($this->once())->method(
            'itemDesensitizationRuleValidateNo'
        )->with($item['desensitizationRule'])->willReturn(true);

        $result = $stub->itemDesensitizationRuleValidatePublic($item);
        $this->assertTrue($result);
    }

    public function testItemDesensitizationRuleValidateTrueNotEmpty()
    {
        $stub = $this->getMockBuilder(DirectoryWidgetRuleMock::class)
                           ->setMethods([
                               'itemDesensitizationRuleValidateYes'
                            ])->getMock();

        $item = array(
            'desensitization' => Directory::DESENSITIZATION['YES'],
            'desensitizationRule' => [3, 4],
            'dataLength' => 5
        );

        $stub->expects($this->once())->method(
            'itemDesensitizationRuleValidateYes'
        )->with($item['desensitizationRule'])->willReturn(true);

        $result = $stub->itemDesensitizationRuleValidatePublic($item);
        $this->assertTrue($result);
    }

    //itemDesensitizationRuleValidateNo
    /**
     * @dataProvider additionProviderItemDesensitizationRuleValidateNo
     */
    public function testItemDesensitizationRuleValidateNo($parameter, $expected)
    {
        $result = $this->stub->itemDesensitizationRuleValidateNoPublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemDesensitizationRuleValidateNo()
    {
        return array(
            array('', true),
            array(array(1), false)
        );
    }

    //itemDesensitizationRuleValidateYes
    /**
     * @dataProvider additionProviderItemDesensitizationRuleValidateYes
     */
    public function testItemDesensitizationRuleValidateYes($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->itemDesensitizationRuleValidateYesPublic($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderItemDesensitizationRuleValidateYes()
    {
        return array(
            array('', '', false),
            array(array(), '', false),
            array(array(1), '', false),
            array(array_fill(0, DirectoryWidgetRule::DESENSITIZATION_RULE_COUNT+1, 2), '', false),
            array(array(1, 4), 4, false),
            array(array(1, 3), 4, true),
            array(array(5, 4), 4, false),
        );
    }
}
