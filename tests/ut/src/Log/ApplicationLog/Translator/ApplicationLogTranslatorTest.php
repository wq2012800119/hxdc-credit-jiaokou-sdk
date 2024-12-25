<?php
namespace Sdk\Log\ApplicationLog\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Log\ApplicationLog\Model\ApplicationLog;
use Sdk\Log\ApplicationLog\Utils\MockObjectGenerate;
use Sdk\Log\ApplicationLog\Utils\TranslatorUtilsTrait;

class ApplicationLogTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ApplicationLogTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsITranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\ITranslator',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $stub = new ApplicationLogTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Model\NullApplicationLog',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $log = array();
        $result = $this->stub->objectToArray($log);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(ApplicationLogTranslator::class)->setMethods(['typeFormatConversion'])->getMock();

        $log = MockObjectGenerate::generateApplicationLog(1);

        $operatorCategoryArray = array('operatorCategory');
        $targetCategoryArray = array('targetCategory');
        $targetActionArray = array('targetAction');
        $stub->expects($this->exactly(3))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $log->getOperatorCategory(), ApplicationLog::OPERATOR_CATEGORY_CN, $operatorCategoryArray
                ],
                [
                    $log->getTargetCategory(), ApplicationLog::TARGET_CATEGORY_CN, $targetCategoryArray
                ],
                [
                    $log->getTargetAction(), ApplicationLog::TARGET_ACTION_CN, $targetActionArray
                ]
            ]));
 
        $result = $stub->objectToArray($log);

        $this->assertEquals($result['operatorCategory'], $operatorCategoryArray);
        $this->assertEquals($result['targetCategory'], $targetCategoryArray);
        $this->assertEquals($result['targetAction'], $targetActionArray);
        
        $this->compareTranslatorEquals($result, $log);
    }
}
