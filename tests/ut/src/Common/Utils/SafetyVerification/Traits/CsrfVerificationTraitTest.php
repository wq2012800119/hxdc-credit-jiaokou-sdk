<?php
namespace Sdk\Common\Utils\SafetyVerification\Traits;

use PHPUnit\Framework\TestCase;

use Marmot\Framework\Classes\Request;

use Sdk\Common\Utils\SafetyVerification\Csrf;

class CsrfVerificationTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(CsrfVerificationTraitMock::class)
                           ->setMethods([
                               'getRequest',
                               'ajaxCsrfVerification',
                               'postMethodCsrfVerification',
                               'getMethodCsrfVerification'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetCsrf()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Utils\SafetyVerification\Csrf',
            $this->stub->getCsrfPublic()
        );
    }

    public function testCsrfVerificationAjax()
    {
        $request = $this->prophesize(Request::class);
        $request->isAjax()->shouldBeCalled(1)->willReturn(true);
        $this->stub->expects($this->exactly(1))->method('getRequest')->willReturn($request->reveal());

        $this->stub->expects($this->exactly(1))->method('ajaxCsrfVerification')->willReturn(true);

        $result = $this->stub->csrfVerificationPublic();

        $this->assertTrue($result);
    }

    public function testCsrfVerificationPost()
    {
        $request = $this->prophesize(Request::class);
        $request->isAjax()->shouldBeCalled(1)->willReturn(false);
        $request->isPostMethod()->shouldBeCalled(1)->willReturn(true);
        $this->stub->expects($this->exactly(2))->method('getRequest')->willReturn($request->reveal());

        $this->stub->expects($this->exactly(1))->method('postMethodCsrfVerification')->willReturn(true);

        $result = $this->stub->csrfVerificationPublic();

        $this->assertTrue($result);
    }

    public function testCsrfVerificationGet()
    {
        $request = $this->prophesize(Request::class);
        $request->isAjax()->shouldBeCalled(1)->willReturn(false);
        $request->isPostMethod()->shouldBeCalled(1)->willReturn(false);
        $request->isGetMethod()->shouldBeCalled(1)->willReturn(true);
        $this->stub->expects($this->exactly(3))->method('getRequest')->willReturn($request->reveal());

        $this->stub->expects($this->exactly(1))->method('getMethodCsrfVerification')->willReturn(true);

        $result = $this->stub->csrfVerificationPublic();

        $this->assertTrue($result);
    }

    public function testCsrfVerificationFalse()
    {
        $request = $this->prophesize(Request::class);
        $request->isAjax()->shouldBeCalled(1)->willReturn(false);
        $request->isPostMethod()->shouldBeCalled(1)->willReturn(false);
        $request->isGetMethod()->shouldBeCalled(1)->willReturn(false);
        $this->stub->expects($this->exactly(3))->method('getRequest')->willReturn($request->reveal());

        $result = $this->stub->csrfVerificationPublic();

        $this->assertFalse($result);
    }

    public function testAjaxCsrfVerification()
    {
        $stub = $this->getMockBuilder(CsrfVerificationTraitMock::class)
                           ->setMethods([
                               'getRequest',
                               'getCsrf'
                            ])->getMock();

        $csrfToken = 'csrfToken';
        
        $request = $this->prophesize(Request::class);
        $request->getHeader('X-CSRF-TOKEN', '')->shouldBeCalled(1)->willReturn($csrfToken);
        $stub->expects($this->exactly(1))->method('getRequest')->willReturn($request->reveal());

        $csrf = $this->prophesize(Csrf::class);
        $csrf->verification($csrfToken)->shouldBeCalled(1)->willReturn(true);
        $stub->expects($this->exactly(1))->method('getCsrf')->willReturn($csrf->reveal());

        $result = $stub->ajaxCsrfVerificationPublic();

        $this->assertTrue($result);
    }

    public function testPostMethodCsrfVerification()
    {
        $stub = $this->getMockBuilder(CsrfVerificationTraitMock::class)
                           ->setMethods([
                               'getRequest',
                               'getCsrf'
                            ])->getMock();

        $csrfToken = 'csrfToken';
        
        $request = $this->prophesize(Request::class);
        $request->post('csrfToken', '')->shouldBeCalled(1)->willReturn($csrfToken);
        $stub->expects($this->exactly(1))->method('getRequest')->willReturn($request->reveal());

        $csrf = $this->prophesize(Csrf::class);
        $csrf->verification($csrfToken)->shouldBeCalled(1)->willReturn(true);
        $stub->expects($this->exactly(1))->method('getCsrf')->willReturn($csrf->reveal());

        $result = $stub->postMethodCsrfVerificationPublic();

        $this->assertTrue($result);
    }

    public function testGetMethodCsrfVerification()
    {
        $stub = new CsrfVerificationTraitMock();

        $result = $stub->getMethodCsrfVerificationPublic();

        $this->assertTrue($result);
    }
}
