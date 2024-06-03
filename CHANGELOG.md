# Change Log

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](http://semver.org/) and [Keep a CHANGELOG](http://keepachangelog.com/).

## [Unreleased][unreleased]
- 

## [4.7.0] - 2024-06-03

### Changed

- Use the pronamic/ideal-issuers library for iDEAL issuers. ([#18](https://github.com/pronamic/wp-pronamic-pay-ingenico/issues/18))

### Composer

- Changed `php` from `>=8.0` to `>=8.1`.

Full set of changes: [`4.6.0...4.7.0`][4.7.0]

[4.7.0]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.6.0...v4.7.0

## [4.6.0] - 2023-12-18

### Commits

- Removed unused class `SecureDataHelper`. ([3fde8c3](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/3fde8c3651cfea6fc636fe23b975036a032f5932))
- Removed unused credit card data helper. ([ab0cd1d](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/ab0cd1dbb65fb732d607fc61277d36530c4257dd))
- Removed `DirectLink` integration. ([51047d6](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/51047d6c9c73b5b9d63ecd151fa6fff169e39638))
- Fixed getting order status with payment ID by default. ([772fa93](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/772fa9321a01cceb4748842ad4a5a212aea4950c))

### Composer

- Changed `php` from `>=7.4` to `>=8.0`.
- Changed `wp-pay/core` from `^4.6` to `v4.14.3`.
	Release notes: https://github.com/pronamic/wp-pay-core/releases/tag/v4.14.3

Full set of changes: [`4.5.4...4.6.0`][4.6.0]

[4.6.0]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.5.4...v4.6.0

## [4.5.4] - 2023-10-13

### Commits

- No longer use removed 'filter' option in setting fields. ([d348204](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/d348204a47b27aa45b9aaf0fa887ea2b527e1cc2))
- Removed unused `use Pronamic\WordPress\Pay\Core\Server;`. ([1450321](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/1450321a16be6f2cddd07675206ddde74e09b889))
- No longer use `Server::get` method, will be removed. ([28f76ed](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/28f76ed0215ffba14cd9a9683c1cb5d502b81932))
- It is recommended not to use reserved keyword "list". ([451066d](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/451066d061e529183dbff7f262862cf9cc9e28a4))
- No longer use HTML <br> element in exception message and escape values. ([2fc139e](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/2fc139ef6e15f052513e931e224013ecb98a2f23))
- Fixed "All output should be run through an escaping function". ([33f0b20](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/33f0b20cd2077247cceae72ff9e8f08090d02cf1))
- Removed old see ref in docblock. ([c0592bb](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/c0592bb8e49a6959cd2aa8b46cad1cb501b06cf6))
- Added iDEAL issuer Nationale Nederlanden. ([bb4cf32](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/bb4cf32d608e925b51f6a22b6750f27a62dd767d))

Full set of changes: [`4.5.3...4.5.4`][4.5.4]

[4.5.4]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.5.3...v4.5.4

## [4.5.3] - 2023-09-11

### Commits

- Merge pull request #12 from pronamic/11-add-ideal-issuer-n26 ([2745635](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/274563563aa6ac0040e4573ea148a5247ca8124d))
- Added new iDEAL issuer N26. ([48e522e](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/48e522e0316e958b134a8de2aa0b58498262a382))

Full set of changes: [`4.5.2...4.5.3`][4.5.3]

[4.5.3]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.5.2...v4.5.3

## [4.5.2] - 2023-07-12

### Commits

- Updated for removed payment ID fallback in formatted payment string (pronamic/wp-pronamic-pay-adyen#23). ([71147a6](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/71147a6e9be8eb1e25e3579f626333e5f4a81394))
- Added support for the COMPLUS parameter. ([be4b079](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/be4b0795bca58fa86ac55e1034b56cc8926525d3))
- Added documentation. ([8ef4cfe](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/8ef4cfe14e1eedec70b4f3db3c21fce5e1398dfa))

Full set of changes: [`4.5.1...4.5.2`][4.5.2]

[4.5.2]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.5.1...v4.5.2

## [4.5.1] - 2023-06-01

### Commits

- Switch from `pronamic/wp-deployer` to `pronamic/pronamic-cli`. ([29818f3](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/29818f3580d3333661c06ff10e8e67c8a40b4602))
- Updated .gitattributes ([33d6475](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/33d64750604da7c1e1d5bdc18b9ce12c115b0045))

Full set of changes: [`4.5.0...4.5.1`][4.5.1]

[4.5.1]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.5.0...v4.5.1

## [4.5.0] - 2023-03-15

### Commits

- Set Composer package type to "wordpress-plugin". ([726774a](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/726774ac8c9aaee14930429097fa707e3f3eb4d0))
- Added Yoursafe iDEAL issuer. ([4ff6f8f](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/4ff6f8f894a466058f0571328d1687df1a825a34))
- Updated .gitattributes ([4547483](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/4547483f50095ead3e34af9d5cf0e3d311bda9cd))
- Requires PHP: 7.4. ([cf55309](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/cf55309daf5748fab07094eedbca091661d660fd))

Full set of changes: [`4.4.1...4.5.0`][4.5.0]

[4.5.0]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.4.1...v4.5.0

## [4.4.1] - 2023-01-31
### Composer

- Changed `php` from `>=8.0` to `>=7.4`.
Full set of changes: [`4.4.0...4.4.1`][4.4.1]

[4.4.1]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.4.0...v4.4.1

## [4.4.0] - 2023-01-18

### Commits

- Added support for iDEAL issuer options. ([00a0f5a](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/00a0f5a221e94eaee8dcaa12c8a31287dc9c0c45))
- Happy 2023. ([23facf0](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/23facf001dc85428ac652d2558e4ef2ba21d2b8b))

Full set of changes: [`4.3.0...4.4.0`][4.4.0]

[4.4.0]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.3.0...v4.4.0

## [4.3.0] - 2022-12-23

### Commits

- Use `pronamic/wp-http` library for remote requests. ([cdfd5a5](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/cdfd5a54f0ce56d051bfe50dfe9c2f7798e049ad))
- Removed usage of deprecated `\FILTER_SANITIZE_STRING` in gateway settings fields. ([58397af](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/58397afb674ae3d709f0baeceec161bcb92f4974))
- Updated manual URL to pronamicpay.com (pronamic/pronamic-pay#15). ([98a1228](https://github.com/pronamic/wp-pronamic-pay-ingenico/commit/98a1228cb2c4781047c12a2f00865f68b97a9a41))

### Composer

- Added `pronamic/wp-http` `^1.2`.
- Changed `php` from `>=5.6.20` to `>=8.0`.
- Changed `wp-pay/core` from `^4.0` to `v4.6.0`.
	Release notes: https://github.com/pronamic/wp-pay-core/releases/tag/v4.2.0

Full set of changes: [`4.2.0...4.3.0`][4.3.0]

[4.3.0]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/v4.2.0...v4.3.0

## [4.2.0] - 2022-09-26
- Updated payment methods registration.

## [4.1.0] - 2022-04-11
- No longer use global gateway mode.

## [4.0.0] - 2022-01-11
### Changed
- Updated to https://github.com/pronamic/wp-pay-core/releases/tag/4.0.0.

## [3.0.0] - 2021-08-05
- Updated to `pronamic/wp-pay-core`  version `3.0.0`.
- Updated to `pronamic/wp-money`  version `2.0.0`.
- Switched to `pronamic/wp-coding-standards`.

## [2.1.3] - 2021-06-18
- Fixed updating payment transaction ID from transaction feedback.

## [2.1.2] - 2021-04-26
- Improved support for bank transfer payment method.

## [2.1.1] - 2020-07-08
- Added exception for Ingenico error when retrieving order status.

## [2.1.0] - 2020-03-19
- Extend from AbstractGatewayIntegration class.

## [2.0.4] - 2019-12-22
- Added URL to manual in gateway settings.
- Improved error handling with exceptions.
- Updated output fields to use payment.
- Updated payment status class name.

## [2.0.3] - 2019-08-27
- Updated packages.

## [2.0.2] - 2019-03-28
- Moved custom payment redirect from plugin to gateway.
- Make use of payment `get_pay_redirect_url()` method.
- Added initial support for Ogone alias creation.
- Added HTML/CSS classes to `TP` parameter settings field.

## [2.0.1] - 2018-12-12
- Updated deprecated function calls.

## [2.0.0] - 2018-05-14
- Switched to PHP namespaces.

## [1.3.4] - 2017-03-15
- Only set credit card data if we have it.

## [1.3.3] - 2016-11-16
- Removed specific ABN AMRO iDEAL Easy PSPID test description.

## [1.3.2] - 2016-10-20
- Added `payment_status_request` feature support.
- Updated SHA-IN parameters list from ingenico.com.
- Updated SHA-OUT parameters list from ingenico.com.
- Removed schedule status check event, this will be part of the Pronamic iDEAL plugin.
- Use new $payment->format_string() function, and remove util function.
- Added support for new Bancontact constant.
- Fixed method `get_default_form_action_url()` visibility.
- Added support for form action URL for OrderStandard Easy.

## [1.3.1] - 2016-07-06
- Get payment ID from request data.

## [1.3.0] - 2016-06-08
- Use `get_form_action_url()` instead of deprecated `get_payment_server_url()`.
- Simplified the gateway payment start function.

## [1.2.9] - 2016-04-12
- Added support for custom Ogone e-Commerce form action URL.
- Renamed OrderStandard to 'e-Commerce'.

## [1.2.8] - 2016-03-22
- Added product and dashboard URLs.
- Updated gateway settings.
- Use UTF-8 URL when blog charset is UTF-8.

## [1.2.7] - 2016-03-02
- Added support for get_settings().
- Moved get_gateway_class() function to the configuration class.
- Removed get_config_class(), no longer required.
- Added an new customer data helper class and use in the gateways.
- Don't set the PARAMPLUS parameter, we already set it earlier in the gateway.
- Also set country and telephone number.

## [1.2.6] - 2016-02-10
- Use PARAMPLUS for the payment ID.

## [1.2.5] - 2016-01-29
- Added an gateway settings class.

## [1.2.4] - 2015-10-21
- Fixed Strict standards: Declaration of Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Gateway should be compatible with Pronamic_WP_Pay_Gateway::start().

## [1.2.3] - 2015-10-15
- Added support for the direct payment method credit card.
- Added support for the direct payment method iDEAL.

## [1.2.2] - 2015-10-14
- Added support for the Ogone TP parameter.

## [1.2.1] - 2015-03-26
- Updated WordPress pay core library to version 1.2.0.
- Return array with output fields instead of HTML.

## [1.2.0] - 2015-02-27
- Updated WordPress pay core library to version 1.1.0.
- Fixed issues with filter_input INPUT_SERVER (https://bugs.php.net/bug.php?id=49184).

## [1.1.0] - 2015-02-18
- Added constant class for the Ogone BRAND parameter.
- Added constant class for the Ogone PM (payment method) parameter/
- Simplified the Ogone data helper classes.
- Added an payment methods list class for the Ogone PMLIST parameter.
- Added direct support for the Bancontact/Mister Cash payment method.

## 1.0.0 - 2015-01-19
- First release.

[unreleased]: https://github.com/wp-pay-gateways/ogone/compare/4.2.0...HEAD
[4.2.0]: https://github.com/pronamic/wp-pronamic-pay-ingenico/compare/4.1.0...4.2.0
[4.1.0]: https://github.com/wp-pay-gateways/ogone/compare/4.0.0...4.1.0
[4.0.0]: https://github.com/wp-pay-gateways/ogone/compare/3.0.0...4.0.0
[3.0.0]: https://github.com/wp-pay-gateways/ogone/compare/2.1.3...3.0.0
[2.1.3]: https://github.com/wp-pay-gateways/ogone/compare/2.1.2...2.1.3
[2.1.2]: https://github.com/wp-pay-gateways/ogone/compare/2.1.1...2.1.2
[2.1.1]: https://github.com/wp-pay-gateways/ogone/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/wp-pay-gateways/ogone/compare/2.0.4...2.1.0
[2.0.4]: https://github.com/wp-pay-gateways/ogone/compare/2.0.3...2.0.4
[2.0.3]: https://github.com/wp-pay-gateways/ogone/compare/2.0.2...2.0.3
[2.0.2]: https://github.com/wp-pay-gateways/ogone/compare/2.0.1...2.0.2
[2.0.1]: https://github.com/wp-pay-gateways/ogone/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/wp-pay-gateways/ogone/compare/1.3.4...2.0.0
[1.3.4]: https://github.com/wp-pay-gateways/ogone/compare/1.3.3...1.3.4
[1.3.3]: https://github.com/wp-pay-gateways/ogone/compare/1.3.2...1.3.3
[1.3.2]: https://github.com/wp-pay-gateways/ogone/compare/1.3.1...1.3.2
[1.3.1]: https://github.com/wp-pay-gateways/ogone/compare/1.3.0...1.3.1
[1.3.0]: https://github.com/wp-pay-gateways/ogone/compare/1.2.9...1.3.0
[1.2.9]: https://github.com/wp-pay-gateways/ogone/compare/1.2.8...1.2.9
[1.2.8]: https://github.com/wp-pay-gateways/ogone/compare/1.2.7...1.2.8
[1.2.7]: https://github.com/wp-pay-gateways/ogone/compare/1.2.6...1.2.7
[1.2.6]: https://github.com/wp-pay-gateways/ogone/compare/1.2.5...1.2.6
[1.2.5]: https://github.com/wp-pay-gateways/ogone/compare/1.2.4...1.2.5
[1.2.4]: https://github.com/wp-pay-gateways/ogone/compare/1.2.3...1.2.4
[1.2.3]: https://github.com/wp-pay-gateways/ogone/compare/1.2.2...1.2.3
[1.2.2]: https://github.com/wp-pay-gateways/ogone/compare/1.2.1...1.2.2
[1.2.1]: https://github.com/wp-pay-gateways/ogone/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/wp-pay-gateways/ogone/compare/1.1.1...1.2.0
[1.1.0]: https://github.com/wp-pay-gateways/ogone/compare/1.0.0...1.1.0
