<?php
namespace Sdk\Attachment\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class AttachmentTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(Attachment::class)
                           ->setMethods([
                               'validate',
                               'getFileName',
                               'getFilePath',
                               'move'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    /**
     * Attachment 领域对象,测试构造函数
     */
    public function testAttachmentConstructor()
    {
        $this->assertEmpty($this->stub->getName());
        $this->assertEmpty($this->stub->getType());
        $this->assertEmpty($this->stub->getTmpName());
        $this->assertEmpty($this->stub->getSize());
        $this->assertEmpty($this->stub->getError());
    }

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->stub->setName('attachmentName');
        $this->assertEquals('attachmentName', $this->stub->getName());
    }

    /**
     * 设置 Attachment setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->stub->setName(array('attachmentName'));
    }
    //name 测试 --------------------------------------------------------   end
    //type 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setType() 正确的传参类型,期望传值正确
     */
    public function testSetTypeCorrectType()
    {
        $this->stub->setType('attachmentType');
        $this->assertEquals('attachmentType', $this->stub->getType());
    }

    /**
     * 设置 Attachment setType() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTypeWrongType()
    {
        $this->stub->setType(array('attachmentType'));
    }
    //type 测试 --------------------------------------------------------   end

    //tmpName 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setTmpName() 正确的传参类型,期望传值正确
     */
    public function testSetTmpNameCorrectType()
    {
        $this->stub->setTmpName('attachmentTmpName');
        $this->assertEquals('attachmentTmpName', $this->stub->getTmpName());
    }

    /**
     * 设置 Attachment setTmpName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTmpNameWrongType()
    {
        $this->stub->setTmpName(array('attachmentTmpName'));
    }
    //tmpName 测试 --------------------------------------------------------   end

    //size 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setSize() 正确的传参类型,期望传值正确
     */
    public function testSetSizeCorrectType()
    {
        $this->stub->setSize(1);
        $this->assertEquals(1, $this->stub->getSize());
    }

    /**
     * 设置 Attachment setSize() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSizeWrongType()
    {
        $this->stub->setSize(array('size'));
    }
    //size 测试 --------------------------------------------------------   end

    //error 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setError() 正确的传参类型,期望传值正确
     */
    public function testSetErrorCorrectType()
    {
        $this->stub->setError(1);
        $this->assertEquals(1, $this->stub->getError());
    }

    /**
     * 设置 Attachment setError() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetErrorWrongType()
    {
        $this->stub->setError(array('error'));
    }
    //error 测试 --------------------------------------------------------   end

    public function testUploadValidateFalse()
    {
        $this->stub->expects($this->exactly(1))->method('validate')->willReturn(false);
        $result = $this->stub->upload();

        $this->assertFalse($result);
    }

    public function testUploadValidate()
    {
        $fileName = 'fileName';
        $date = date('Ym').'/';
        $filePath = 'filePath';

        $this->stub->expects($this->exactly(1))->method('validate')->willReturn(true);
        $this->stub->expects($this->exactly(1))->method('getFileName')->willReturn($fileName);
        $this->stub->expects($this->exactly(1))->method('getFilePath')->with($fileName, $date)->willReturn($filePath);
        $this->stub->expects($this->exactly(1))->method('move')->with($filePath)->willReturn(true);

        $result = $this->stub->upload();
        
        $this->assertEquals($result, $date.$fileName);
    }

    public function testValidate()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)
                           ->setMethods([
                               'validateFileIsExist',
                               'validateFileExtension',
                               'validateFileSize',
                               'validateFileError'
                            ])->getMock();

        $stub->expects($this->exactly(1))->method('validateFileIsExist')->willReturn(true);
        $stub->expects($this->exactly(1))->method('validateFileExtension')->willReturn(true);
        $stub->expects($this->exactly(1))->method('validateFileSize')->willReturn(true);
        $stub->expects($this->exactly(1))->method('validateFileError')->willReturn(true);

        $result = $stub->validatePublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileIsExistFalse()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getName'])->getMock();
        $stub->expects($this->exactly(1))->method('getName')->willReturn('');

        $result = $stub->validateFileIsExistPublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function testValidateFileIsExist()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getName'])->getMock();
        $stub->expects($this->exactly(1))->method('getName')->willReturn('name');

        $result = $stub->validateFileIsExistPublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileExtensionFalse()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getAttachmentExtension'])->getMock();
        $stub->expects($this->exactly(1))->method('getAttachmentExtension')->willReturn('');

        $result = $stub->validateFileExtensionPublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_EXTENSION_NOT_SUPPORTED, Core::getLastError()->getId());
    }

    public function testValidateFileExtension()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getAttachmentExtension'])->getMock();
        $stub->expects($this->exactly(1))->method('getAttachmentExtension')->willReturn('doc');

        $result = $stub->validateFileExtensionPublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileSizeFalse()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getSize'])->getMock();
        $stub->expects($this->exactly(1))->method('getSize')->willReturn(Attachment::MAX_FILE_SIZE+1);

        $result = $stub->validateFileSizePublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_SIZE_LIMIT_EXCEEDED, Core::getLastError()->getId());
    }

    public function testValidateFileSize()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getSize'])->getMock();
        $stub->expects($this->exactly(1))->method('getSize')->willReturn(Attachment::MAX_FILE_SIZE);

        $result = $stub->validateFileSizePublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileErrorFalse()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getError'])->getMock();
        $stub->expects($this->exactly(1))->method('getError')->willReturn(Attachment::DEFAULT_ERROR_CODE+1);

        $result = $stub->validateFileErrorPublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_UPLOAD_INCORRECT, Core::getLastError()->getId());
    }

    public function testValidateFileError()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getError'])->getMock();
        $stub->expects($this->exactly(1))->method('getError')->willReturn(Attachment::DEFAULT_ERROR_CODE);

        $result = $stub->validateFileErrorPublic();
        
        $this->assertTrue($result);
    }

    public function testGetAttachmentExtension()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getName'])->getMock();
        $stub->expects($this->exactly(1))->method('getName')->willReturn('1.jpg');

        $result = $stub->getAttachmentExtensionPublic();
        
        $this->assertEquals($result, 'jpg');
    }

    public function testGetFileName()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods([
                    'getName',
                    'getAttachmentExtension'
                ])->getMock();

        $stub->expects($this->exactly(1))->method('getAttachmentExtension')->willReturn('jpg');
        $stub->expects($this->exactly(1))->method('getName')->willReturn('name');

        $result = $stub->getFileNamePublic();
        
        $this->assertIsString($result);
    }

    public function testMove()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods([
                    'getTmpName',
                    'builtInMove'
                ])->getMock();

        $filePath = 'builtInMove';
        $tmpName = 'tmpName';
        $stub->expects($this->exactly(1))->method('getTmpName')->willReturn($tmpName);
        $stub->expects($this->exactly(1))->method('builtInMove')->willReturn(true);

        $result = $stub->movePublic($filePath);
        $this->assertTrue($result);
    }

    public function testMoveFalse()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods([
                    'getTmpName',
                    'builtInMove'
                ])->getMock();

        $filePath = 'builtInMove';
        $tmpName = 'tmpName';
        $stub->expects($this->exactly(1))->method('getTmpName')->willReturn($tmpName);
        $stub->expects($this->exactly(1))->method('builtInMove')->willReturn(false);

        $result = $stub->movePublic($filePath);
        $this->assertFalse($result);
        $this->assertEquals(FILE_UPLOAD_PATH_NOT_EXIST, Core::getLastError()->getId());
    }

    public function testBuiltInMove()
    {
        $stub = new AttachmentMock();

        $tmpName = 'tmpName';
        $filePath = 'filePath';
        $result = $stub->builtInMovePublic($tmpName, $filePath);
        $this->assertFalse($result);
    }
}
