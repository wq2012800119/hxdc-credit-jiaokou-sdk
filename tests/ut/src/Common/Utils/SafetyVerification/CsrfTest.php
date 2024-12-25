<?php
namespace Sdk\Common\Utils\SafetyVerification;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class CsrfTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(CsrfMock::class)
                           ->setMethods([
                               'randomChar',
                               'generateCacheToken',
                               'get'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetCacheLayer()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Utils\Cache\CsrfCache',
            $this->stub->getCacheLayer()
        );
    }

    public function testGenerateToken()
    {
        $randomChar = 'randomChar';
        $this->stub->expects($this->exactly(1))->method(
            'randomChar'
        )->with(Csrf::CSRF_TOKEN_LENGTH)->willReturn($randomChar);

        $csrfToken = md5($randomChar);

        $this->stub->expects($this->exactly(1))->method('generateCacheToken')->with($csrfToken)->willReturn(true);

        $result = $this->stub->generateToken();

        $this->assertEquals($result, $csrfToken);
    }

    public function testGenerateCacheToken()
    {
        $this->stub = $this->getMockBuilder(CsrfMock::class)
                           ->setMethods(['save'])
                           ->getMock();

        $csrfToken = md5('csrfToken');
        $cacheKey = Csrf::CSRF_CACHE_ID.$csrfToken;
        $expirationTime = Csrf::EXPIRATION_TIME;

        $this->stub->expects($this->exactly(1))->method(
            'save'
        )->with($cacheKey, $csrfToken, $expirationTime)->willReturn(true);

        $result = $this->stub->generateCacheTokenPublic($csrfToken);

        $this->assertTrue($result);
    }

    public function testVerificationTrue()
    {
        $csrfToken = $csrfTokenCache = md5('csrfToken');
        $cacheKey = Csrf::CSRF_CACHE_ID.$csrfToken;

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($csrfTokenCache);

        $result = $this->stub->verification($csrfToken);

        $this->assertTrue($result);
    }

    public function testVerificationFalse()
    {
        $csrfToken = md5('csrfToken');
        $cacheKey = Csrf::CSRF_CACHE_ID.$csrfToken;
        $csrfTokenCache = 'csrfTokenCache';

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($csrfTokenCache);

        $result = $this->stub->verification($csrfToken);

        $this->assertEquals(Core::getLastError()->getId(), CSRF_VERIFICATION_FAILURE);
        $this->assertFalse($result);
    }
}
