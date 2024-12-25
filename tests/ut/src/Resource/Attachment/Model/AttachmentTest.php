<?php
namespace Sdk\Resource\Attachment\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Resource\Directory\Model\Directory;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class AttachmentTest extends TestCase
{
    private $attachmentStub;

    protected function setUp(): void
    {
        $this->attachmentStub = new Attachment();
    }

    protected function tearDown(): void
    {
        unset($this->attachmentStub);
    }

    public function testExtendsAttachment()
    {
        $this->assertInstanceOf(
            'Sdk\Attachment\Model\Attachment',
            $this->attachmentStub
        );
    }

    /**
     * Attachment 领域对象,测试构造函数
     */
    public function testAttachmentConstructor()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->attachmentStub->getStaff()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->attachmentStub->getDirectory()
        );
    }

    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->attachmentStub->setStaff($staff);
        $this->assertEquals($staff, $this->attachmentStub->getStaff());
    }

    /**
     * 设置 Attachment setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->attachmentStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    //directory 测试 -------------------------------------------------------- start
    /**
     * 设置 Attachment setDirectory() 正确的传参类型,期望传值正确
     */
    public function testSetDirectoryCorrectType()
    {
        $directory = new Directory();
        $this->attachmentStub->setDirectory($directory);
        $this->assertEquals($directory, $this->attachmentStub->getDirectory());
    }

    /**
     * 设置 Attachment setDirectory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectoryWrongType()
    {
        $this->attachmentStub->setDirectory(array('directory'));
    }
    //directory 测试 --------------------------------------------------------   end

    public function testValidate()
    {
        $attachmentStub = $this->getMockBuilder(AttachmentMock::class)
                           ->setMethods([
                               'validateFileIsExist',
                               'validateFileExtension',
                               'validateFileSize',
                               'validateFileError',
                               'validateFileName'
                            ])->getMock();

        $attachmentStub->expects($this->exactly(1))->method('validateFileIsExist')->willReturn(true);
        $attachmentStub->expects($this->exactly(1))->method('validateFileExtension')->willReturn(true);
        $attachmentStub->expects($this->exactly(1))->method('validateFileSize')->willReturn(true);
        $attachmentStub->expects($this->exactly(1))->method('validateFileError')->willReturn(true);
        $attachmentStub->expects($this->exactly(1))->method('validateFileName')->willReturn(true);

        $result = $attachmentStub->validatePublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileSizeFalse()
    {
        $attachmentStub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getSize'])->getMock();
        $attachmentStub->expects($this->exactly(1))->method('getSize')->willReturn(Attachment::MAX_FILE_SIZE+1);

        $result = $attachmentStub->validateFileSizePublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_SIZE_LIMIT_EXCEEDED, Core::getLastError()->getId());
    }

    public function testValidateFileSize()
    {
        $attachmentStub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getSize'])->getMock();
        $attachmentStub->expects($this->exactly(1))->method('getSize')->willReturn(Attachment::MAX_FILE_SIZE);

        $result = $attachmentStub->validateFileSizePublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileExtensionFalse()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getAttachmentExtension'])->getMock();
        $stub->expects($this->exactly(1))->method('getAttachmentExtension')->willReturn('test');

        $result = $stub->validateFileExtensionPublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_EXTENSION_NOT_SUPPORTED, Core::getLastError()->getId());
    }

    public function testValidateFileExtension()
    {
        $stub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getAttachmentExtension'])->getMock();
        $stub->expects($this->exactly(1))->method('getAttachmentExtension')->willReturn('xls');

        $result = $stub->validateFileExtensionPublic();
        
        $this->assertTrue($result);
    }

    public function testValidateFileNameFalse()
    {
        $attachmentStub = $this->getMockBuilder(AttachmentMock::class)->setMethods(['getName'])->getMock();

        $name = 'test';
        $attachmentStub->expects($this->exactly(1))->method('getName')->willReturn($name);

        $result = $attachmentStub->validateFileNamePublic();
        
        $this->assertFalse($result);
        $this->assertEquals(FILE_UPLOAD_INCORRECT, Core::getLastError()->getId());
    }

    public function testValidateFileNameTrue()
    {
        $attachmentStub = $this->getMockBuilder(AttachmentMock::class)
                        ->setMethods(['getName', 'getDirectory'])->getMock();

        $directory = \Sdk\Resource\Directory\Utils\MockObjectGenerate::generateDirectory(1);

        $name = $directory->getName().'_'.$directory->getIdentify().'_'.$directory->getVersion().'.xls';
        $attachmentStub->expects($this->exactly(1))->method('getName')->willReturn($name);
        $attachmentStub->expects($this->exactly(1))->method('getDirectory')->willReturn($directory);

        $result = $attachmentStub->validateFileNamePublic();
        
        $this->assertTrue($result);
    }

    public function testGetFileName()
    {
        $attachmentStub = $this->getMockBuilder(AttachmentMock::class)->setMethods([
                    'getName',
                    'getAttachmentExtension',
                    'getStaff'
                ])->getMock();

        $staff = new OrganizationUserStaff(1);
        $attachmentStub->expects($this->exactly(1))->method('getAttachmentExtension')->willReturn('jpg');
        $attachmentStub->expects($this->exactly(1))->method('getName')->willReturn('name');
        $attachmentStub->expects($this->exactly(1))->method('getStaff')->willReturn($staff);

        $result = $attachmentStub->getFileNamePublic();
        
        $this->assertIsString($result);
    }
}
