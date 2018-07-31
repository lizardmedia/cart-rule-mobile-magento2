<?php
declare(strict_types=1);

/**
 * File:MobileRuleTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Test\Unit\Observer;

use LizardMedia\CartRuleMobile\Model\Rule\Condition\Mobile;
use LizardMedia\CartRuleMobile\Observer\MobileRule;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Class MobileRuleTest
 * @package LizardMedia\CartRuleMobile\Test\Unit\Observer
 */
class MobileRuleTest extends TestCase
{
    /**
     * @test
     */
    public function testExecute()
    {
        $observer = new MobileRule();

        /** @var MockObject|Observer $dto */
        $dto = $this->getMockBuilder(Observer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $additional = new DataObject();
        $dto->expects($this->once())
            ->method('getData')
            ->with('additional')
            ->willReturn($additional);

        $observer->execute($dto);

        $this->assertEquals(
            [
                [
                    'label' => __('Mobile device'),
                    'value' => Mobile::class
                ]
            ],
            $additional->getConditions()
        );
    }
}
