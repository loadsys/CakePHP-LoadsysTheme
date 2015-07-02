# CakePHP-LoadsysTheme

[![Latest Version](https://img.shields.io/github/release/loadsys/CakePHP-LoadsysTheme.svg?style=flat-square)](https://github.com/loadsys/CakePHP-LoadsysTheme/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/loadsys/cakephp-loadsys-theme.svg?style=flat-square)](https://packagist.org/packages/loadsys/cakephp-loadsys-theme)

<!--
[![Build Status](https://travis-ci.org/loadsys/CakePHP-LoadsysTheme.svg?branch=master&style=flat-square)](https://travis-ci.org/loadsys/CakePHP-LoadsysTheme)
[![Coverage Status](https://coveralls.io/repos/loadsys/CakePHP-LoadsysTheme/badge.svg)](https://coveralls.io/r/loadsys/CakePHP-LoadsysTheme)
-->

CakePHP 3.x bake generation theme that matches Loadsys' code sniffer standards.

## Requirements

## Installation

### Composer

````bash
$ composer require loadsys/cakephp-loadsys-theme:dev-master
````

## Usage ##

* Add this plugin to your application by adding this line to your bootstrap.php

```php
Plugin::load('LoadsysTheme');
```

* Use this Theme when baking content via the `--theme` option for the `bake` command like so:

````bash
$ ./vendor/bin/cake bake all --theme LoadsysTheme name-of-thing
````

## Contributing

### Reporting Issues

Please use [GitHub Isuses](https://github.com/loadsys/CakePHP-LoadsysTheme/issues) for listing any known defects or issues.

### Development

When developing this plugin, please fork and issue a PR for any new development.

## License ##

[MIT](https://github.com/loadsys/CakePHP-LoadsysTheme/blob/master/LICENSE.md)


## Copyright ##

[Loadsys Web Strategies](http://www.loadsys.com) 2015
