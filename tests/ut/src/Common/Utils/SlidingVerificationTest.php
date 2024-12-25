<?php
namespace Sdk\Common\Utils;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

class SlidingVerificationTest extends TestCase
{
    use CharacterGeneratorTrait;

    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(SlidingVerificationMock::class)
                           ->setMethods([
                               'verificationWidth',
                               'verificationSlidingTime',
                               'verificationYAxisCoordinateValues'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetCacheLayer()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Utils\Cache\SlidingVerificationCache',
            $this->stub->getCacheLayer()
        );
    }

    public function testExtendsDataCacheQuery()
    {
        $this->assertInstanceOf(
            'Marmot\Framework\Query\DataCacheQuery',
            $this->stub
        );
    }

    public function testGenerateCacheSecretKey()
    {
        $stub = $this->getMockBuilder(SlidingVerificationMock::class)
                           ->setMethods(['save'])
                           ->getMock();
        $type = 'login';
        $width = 12;

        $cacheKey = SlidingVerification::SLIDING_VERIFICATION_CACHE_ID.$type;
        $expirationTime = SlidingVerification::EXPIRATION_TIME;

        $stub->expects($this->exactly(1))->method(
            'save'
        )->with($cacheKey, $width, $expirationTime)->willReturn(true);

        $result = $stub->generateCacheWidthPublic($width, $type);

        $this->assertTrue($result);
    }

    public function testVerification()
    {
        $width = 120;
        $type = 'login';
        $slidingTime = 1000;
        $yAxisCoordinateValues = array('yAxisCoordinateValues');

        $this->stub->expects($this->exactly(1))->method('verificationWidth')->with($width, $type)->willReturn(true);
        $this->stub->expects($this->exactly(1))->method(
            'verificationSlidingTime'
        )->with($slidingTime)->willReturn(true);
        $this->stub->expects($this->exactly(1))->method(
            'verificationYAxisCoordinateValues'
        )->with($yAxisCoordinateValues)->willReturn(true);

        $result = $this->stub->verification($width, $type, $slidingTime, $yAxisCoordinateValues);

        $this->assertTrue($result);
    }

    public function testVerificationWidthTrue()
    {
        $stub = $this->getMockBuilder(SlidingVerificationMock::class)
                           ->setMethods(['get'])
                           ->getMock();

        $width = 120;
        $type = 'login';
        $cacheKey = SlidingVerification::SLIDING_VERIFICATION_CACHE_ID.$type;
        $widthCache = SlidingVerification::WIDTH_OFFSET_MAX+$width;

        $stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($widthCache);
        $result = $stub->verificationWidthPublic($width, $type);

        $this->assertTrue($result);
    }

    public function testVerificationWidthFalse()
    {
        $stub = $this->getMockBuilder(SlidingVerificationMock::class)
                           ->setMethods(['get'])
                           ->getMock();

        $width = 0;
        $type = 'login';
        $cacheKey = SlidingVerification::SLIDING_VERIFICATION_CACHE_ID.$type;
        $widthCache = 0;

        $stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($widthCache);
        $result = $stub->verificationWidthPublic($width, $type);

        $this->assertFalse($result);
        $this->assertEquals(SLIDING_VERIFICATION_INCORRECT, Core::getLastError()->getId());
    }

    public function testVerificationSlidingTimeTrue()
    {
        $stub = new SlidingVerificationMock();
        $slidingTime = SlidingVerification::SLIDING_TIME_MAX;

        $result = $stub->verificationSlidingTimePublic($slidingTime);

        $this->assertTrue($result);
    }

    public function testVerificationSlidingTimeFalse()
    {
        $stub = new SlidingVerificationMock();
        $slidingTime = SlidingVerification::SLIDING_TIME_MAX+1;

        $result = $stub->verificationSlidingTimePublic($slidingTime);

        $this->assertFalse($result);
        $this->assertEquals(SLIDING_VERIFICATION_INCORRECT, Core::getLastError()->getId());
    }

    public function testVerificationYAxisCoordinateValuesFalse()
    {
        $stub = new SlidingVerificationMock();
        $yAxisCoordinateValues = array();

        $result = $stub->verificationYAxisCoordinateValuesPublic($yAxisCoordinateValues);

        $this->assertFalse($result);
        $this->assertEquals(SLIDING_VERIFICATION_INCORRECT, Core::getLastError()->getId());
    }

    public function testVerificationYAxisCoordinateValuesTrue()
    {
        $stub = new SlidingVerificationMock();
        $yAxisCoordinateValues = array(12, 13, 14);

        $result = $stub->verificationYAxisCoordinateValuesPublic($yAxisCoordinateValues);

        $this->assertTrue($result);
    }
}
