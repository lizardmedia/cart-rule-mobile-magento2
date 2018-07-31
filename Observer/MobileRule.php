<?php
declare(strict_types=1);

/**
 * File:MobileRule.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Observer;

use LizardMedia\CartRuleMobile\Model\Rule\Condition\Mobile;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class MobileRule
 * @package LizardMedia\CartRuleMobile\Observer
 */
class MobileRule implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $additional = $observer->getData('additional');
        $conditions = array_merge_recursive((array)$additional->getConditions(), [
            $this->getMobileConditionDefinition()
        ]);
        $additional->setConditions($conditions);
    }

    /**
     * @return array
     */
    private function getMobileConditionDefinition(): array
    {
        return [
            'label'=> __('Mobile device'),
            'value'=> Mobile::class
        ];
    }
}
