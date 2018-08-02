<?php
declare(strict_types=1);

/**
 * File:MobileTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Test\Unit\Model\Rule\Condition;

use LizardMedia\CartRuleMobile\Api\MobileDetectorInterface;
use LizardMedia\CartRuleMobile\Model\Rule\Condition\Mobile;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\Model\AbstractModel;
use Magento\Rule\Model\Condition\Context;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Class MobileTest
 * @package LizardMedia\CartRuleMobile\Test\Unit\Model\Rule\Condition
 */
class MobileTest extends TestCase
{
    /**
     * @var MockObject|Context
     */
    private $context;

    /**
     * @var MockObject|Yesno
     */
    private $sourceYesNo;

    /**
     * @var MockObject|MobileDetectorInterface
     */
    private $mobileDetector;

    /**
     * @var MockObject|Mobile
     */
    private $rule;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->sourceYesNo = $this->getMockBuilder(Yesno::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->mobileDetector = $this->getMockBuilder(MobileDetectorInterface::class)
            ->getMock();

        $this->rule = $this->getMockBuilder(Mobile::class)
            ->setConstructorArgs(
                [
                    $this->context,
                    $this->sourceYesNo,
                    $this->mobileDetector
                ]
            )->setMethods(
                [
                    'callParentConstructor',
                    'getValue',
                    'hasData',
                    'getData',
                    'setData'
                ]
            )->getMock();
    }

    /**
     * @test
     * @dataProvider validateDataProvider
     * @param $ruleForMobile
     * @param $isMobile
     * @param $expected
     */
    public function testValidate($ruleForMobile, $isMobile, $expected)
    {
        $this->rule->expects($this->once())
            ->method('getValue')
            ->willReturn($ruleForMobile);
        $this->mobileDetector->expects($this->once())
            ->method('isMobileDevice')
            ->willReturn($isMobile);

        $abstractModel = $this->getMockBuilder(AbstractModel::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals($expected, $this->rule->validate($abstractModel));
    }

    /**
     * @test
     */
    public function testGetInputType()
    {
        $this->assertEquals('select', $this->rule->getInputType());
    }

    /**
     * @test
     */
    public function testGetValueElementType()
    {
        $this->assertEquals('select', $this->rule->getValueElementType());
    }

    /**
     * @test
     */
    public function testGetValueSelectOptions()
    {
        $expected = ['Yes', 'No'];
        $this->rule->expects($this->once())
            ->method('hasData')
            ->with('value_select_options')
            ->willReturn(false);
        $this->rule->expects($this->once())
            ->method('setData')
            ->with('value_select_options', $expected);
        $this->rule->expects($this->once())
            ->method('getData')
            ->with('value_select_options')
            ->willReturn($expected);
        $this->sourceYesNo->expects($this->once())
            ->method('toOptionArray')
            ->willReturn($expected);

        $this->assertEquals($expected, $this->rule->getValueSelectOptions());
    }

    /**
     * @test
     */
    public function testLoadAttributeOptions()
    {
        $this->rule->expects($this->once())
            ->method('setData')
            ->with(
                'attribute_option',
                [
                    'is_mobile' => __('Mobile device')
                ]
            );
        $this->assertEquals($this->rule, $this->rule->loadAttributeOptions());
    }

    /**
     * @return array
     */
    public function validateDataProvider(): array
    {
        return [
            [
                true,
                true,
                true
            ],
            [
                false,
                false,
                true
            ],
            [
                false,
                true,
                false
            ],
            [
                true,
                false,
                false
            ]
        ];
    }
}
