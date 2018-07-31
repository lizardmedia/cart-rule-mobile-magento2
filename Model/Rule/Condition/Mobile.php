<?php
declare(strict_types=1);

/**
 * File:Mobile.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Model\Rule\Condition;

use LizardMedia\CartRuleMobile\Api\MobileDetectorInterface;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\Model\AbstractModel;
use Magento\Rule\Model\Condition\AbstractCondition;
use Magento\Rule\Model\Condition\Context;

/**
 * Class Mobile
 * @package LizardMedia\CartRuleMobile\Model\Rule\Condition
 */
class Mobile extends AbstractCondition
{
    /**
     * @var Yesno
     */
    protected $sourceYesNo;

    /**
     * @var MobileDetectorInterface
     */
    private $mobileDetector;

    /**
     * Constructor
     * @param Context $context
     * @param Yesno $sourceYesNo
     * @param MobileDetectorInterface $mobileDetector
     * @param array $data
     */
    public function __construct(
        Context $context,
        Yesno $sourceYesNo,
        MobileDetectorInterface $mobileDetector,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->sourceYesNo = $sourceYesNo;
        $this->mobileDetector = $mobileDetector;
    }

    /**
     * @param AbstractModel $model
     * @return bool
     */
    public function validate(AbstractModel $model)
    {
        $enabledOnMobile = (bool)$this->getValue();
        $isMobile = $this->mobileDetector->isMobileDevice();

        return $enabledOnMobile === $isMobile;
    }

    /**
     * @return string
     */
    public function getInputType()
    {
        return 'select';
    }

    /**
     * @return string
     */
    public function getValueElementType()
    {
        return 'select';
    }

    /**
     * @return array|mixed
     */
    public function getValueSelectOptions()
    {
        if (!$this->hasData('value_select_options')) {
            $this->setData(
                'value_select_options',
                $this->sourceYesNo->toOptionArray()
            );
        }
        return $this->getData('value_select_options');
    }

    /**
     * @return Mobile
     */
    public function loadAttributeOptions()
    {
        $this->setData(
            'attribute_option',
            [
                'is_mobile' => __('Mobile device')
            ]
        );
        return $this;
    }
}
