<?php
namespace Sdk\Role\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Role\Utils\MockObjectGenerate;
use Sdk\Role\Utils\TranslatorUtilsTrait;

class RoleRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RoleRestfulTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIRestfulTranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\IRestfulTranslator',
            $this->stub
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Role\Model\NullRole',
            $result
        );
    }

    public function testArrayToObject()
    {
        $role = MockObjectGenerate::generateRole(1);

        $expression['data']['id'] = $role->getId();
        $expression['data']['attributes']['name'] = $role->getName();
        $expression['data']['attributes']['purview'] = $role->getPurview();
        $expression['data']['attributes']['status'] = $role->getStatus();
        $expression['data']['attributes']['statusTime'] = $role->getStatusTime();
        $expression['data']['attributes']['createTime'] = $role->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $role->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Role\Model\Role',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testObjectToArrayEmpty()
    {
        $role = array();
        $result = $this->stub->objectToArray($role);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $role = MockObjectGenerate::generateRole(1);

        $result = $this->stub->objectToArray($role);
        $this->compareRestfulTranslatorEquals($role, $result);
    }
}
