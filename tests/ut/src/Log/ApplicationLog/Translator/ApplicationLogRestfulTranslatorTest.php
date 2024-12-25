<?php
namespace Sdk\Log\ApplicationLog\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Log\ApplicationLog\Utils\MockObjectGenerate;
use Sdk\Log\ApplicationLog\Utils\TranslatorUtilsTrait;

class ApplicationLogRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ApplicationLogRestfulTranslator();
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

    public function testObjectToArray()
    {
        $log = MockObjectGenerate::generateApplicationLog(1);
        $result = $this->stub->objectToArray($log);

        $this->assertEmpty($result);
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Model\NullApplicationLog',
            $result
        );
    }

    public function testArrayToObject()
    {
        $log = MockObjectGenerate::generateApplicationLog(1);

        $expression['data']['id'] = $log->getId();
        $expression['data']['attributes']['operatorId'] = $log->getOperatorId();
        $expression['data']['attributes']['operatorIdentify'] = $log->getOperatorIdentify();
        $expression['data']['attributes']['operatorCategory'] = $log->getOperatorCategory();
        $expression['data']['attributes']['targetCategory'] = $log->getTargetCategory();
        $expression['data']['attributes']['targetAction'] = $log->getTargetAction();
        $expression['data']['attributes']['targetId'] = $log->getTargetId();
        $expression['data']['attributes']['targetName'] = $log->getTargetName();
        $expression['data']['attributes']['description'] = $log->getDescription();
        $expression['data']['attributes']['errorId'] = $log->getErrorId();
        $expression['data']['attributes']['status'] = $log->getStatus();
        $expression['data']['attributes']['statusTime'] = $log->getStatusTime();
        $expression['data']['attributes']['createTime'] = $log->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $log->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Model\ApplicationLog',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }
}
