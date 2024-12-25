<?php
namespace Sdk\Role\Purview\Model;

use PHPUnit\Framework\TestCase;

class PurviewFactoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new PurviewFactoryMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetPurviewExist()
    {
        $modelList = PurviewFactory::MAPS;

        foreach ($modelList as $resource => $model) {
            $result = $this->stub->getPurviewPublic($resource);

            //断言两个参数相同
            $this->assertInstanceOf($model, $result);
            $this->assertInstanceOf('Sdk\Role\Purview\Model\IPurviewAble', $result);
        }
    }

    public function testGetPurviewNotExist()
    {
        $resource = 'tests';

        $result = $this->stub->getPurviewPublic($resource);
        $this->assertInstanceOf('Sdk\Role\Purview\Model\NullPurview', $result);
    }
}
