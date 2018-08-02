<?php
declare(strict_types=1);

/**
 * File:MobileDetector.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace LizardMedia\CartRuleMobile\Model;

use LizardMedia\CartRuleMobile\Api\MobileDetectorInterface;
use Zend_Http_UserAgent;

/**
 * Class MobileDetector
 * @package LizardMedia\CartRuleMobile\Model
 */
class MobileDetector implements MobileDetectorInterface
{
    /**
     * @var Zend_Http_UserAgent
     */
    private $userAgent;

    /**
     * MobileDetector constructor.
     * @param Zend_Http_UserAgent $userAgent
     */
    public function __construct(
        Zend_Http_UserAgent $userAgent
    ) {
        $this->userAgent = $userAgent;
    }

    /**
     * @return bool
     */
    public function isMobileDevice(): bool
    {
        return (bool)preg_match(
            '/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i',
            $this->userAgent->getUserAgent()
        );

    }
}
