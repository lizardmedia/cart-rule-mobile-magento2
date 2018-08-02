<?php
declare(strict_types=1);

/**
 * File:MobileDetectorInterface.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Api;

/**
 * Interface MobileDetectorInterface
 * @package LizardMedia\CartRuleMobile\Api
 */
interface MobileDetectorInterface
{
    /**
     * @return bool
     */
    public function isMobileDevice(): bool;
}
