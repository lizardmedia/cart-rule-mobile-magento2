[![Build Status](https://scrutinizer-ci.com/g/lizardmedia/cart-rule-mobile-magento2/badges/build.png?b=master)](https://scrutinizer-ci.com/g/lizardmedia/cart-rule-mobile-magento2/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lizardmedia/cart-rule-mobile-magento2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lizardmedia/cart-rule-mobile-magento2/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/lizardmedia/module-cart-rule-mobile/v/stable)](https://packagist.org/packages/lizardmedia/module-cart-rule-mobile)
[![License](https://poser.pugx.org/lizardmedia/module-cart-rule-mobile/license)](https://packagist.org/packages/lizardmedia/module-cart-rule-mobile)

# Magento2 Cart Rule Mobile #

A Magento2 module adding a custom Sales Rule for mobile devices. 

It allows you to choose if the rule should be applied to mobile devices only or
to desktop devices only.

#### Device detection ####

The rule uses a user-agent-based detection system. If you wish to override the detection
mthod simply change the implementation of ```\LizardMedia\CartRuleMobile\Api\MobileDetectorInterface```.

## Prerequisites ##

* Magento 2.2 or higher
* PHP 7.1

## Installing ##

You can install the module by downloading a .zip file and unpacking it inside
``app/code/LizardMedia/CartRuleMobile`` directory inside your Magento
or via Composer (required).

To install the module via Composer simply run
```
composer require lizardmedia/module-cart-rule-mobile
```

Than enable the module by running these command in the root of your Magento installation
```
bin/magento module:enable LizardMedia_CartRuleMobile
bin/magento setup:upgrade
```

## Versioning ##

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/lizardmedia/cart-rule-mobile-magento2/tags).

## Authors

* **Maciej Sławik** - [Lizard Media](https://github.com/lizardmedia)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details 