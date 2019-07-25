# Composer Exclusive Install

A Composer plugin that prevents more than one `install` or `update` operation at a time. The lock isn't global,
but project-based and located in the `vendor` folder. After the command is completed, the lock is released even
if it wasn't completed normally.

> **Warning**: the plugin will not work in different docker containers with shared `vendor` location!
  If you have any ideas on how to implement this, please describe your idea in the
  [issue](https://github.com/erickskrauch/composer-exclusive-install/issues/new).

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

## Installation

The plugin should be installed globally.

```bash
composer global require erickskrauch/composer-exclusive-install
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/erickskrauch/composer-exclusive-install.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/erickskrauch/composer-exclusive-install.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/erickskrauch/composer-exclusive-install
[link-downloads]: https://packagist.org/packages/erickskrauch/composer-exclusive-install/stats
