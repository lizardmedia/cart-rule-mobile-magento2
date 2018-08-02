<?php
declare(strict_types=1);

/**
 * File:MobileDetectorTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Test\Unit\Model;

use LizardMedia\CartRuleMobile\Model\MobileDetector;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Zend_Http_UserAgent;

/**
 * Class MobileDetectorTest
 * @package LizardMedia\CartRuleMobile\Test\Unit\Model
 */
class MobileDetectorTest extends TestCase
{
    /**
     * @test
     */
    public function testIsMobile()
    {
        /** @var MockObject|Zend_Http_UserAgent $userAgent */
        $userAgent = $this->getMockBuilder(Zend_Http_UserAgent::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mobileDetector = new MobileDetector($userAgent);

        $userAgent->expects($this->once())
            ->method('getUserAgent')
            ->willReturn('android');

        $this->assertTrue($mobileDetector->isMobileDevice());
    }
}
