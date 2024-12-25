<?php
namespace Sdk\Resource\UploadDataTask\Model;

use PHPUnit\Framework\TestCase;

class NullUploadDataTaskRecordTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullUploadDataTaskRecord::getInstance();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub
        );
    }

    public function testExtendsUploadDataTaskRecord()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord',
            $this->stub
        );
    }
}
