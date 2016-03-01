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

* CakePHP 3.x


## Installation

````bash
$ composer require loadsys/cakephp-loadsys-theme:~1.0
````


## Usage

* Add this plugin to your application by adding this line to your bootstrap.php

````php
CakePlugin::load('LoadsysTheme');
````

* To use when baking, use the CLI option `--theme LoadsysTheme` like so

````bash
$ ./vendor/bin/cake bake all --theme LoadsysTheme name-of-thing
````

## Notable Changes

### Tabs instead of spaces

Loadsys has chosen to ignore the requirement of PSR-2 to use spaces for indenting. We've found tabs to be more convenient, and we're keeping them. If you disagree, that's fine -- this plugin isn't going to be much use to you.

### K&R/1TBS Braces

We're also sticking to [K&R style](https://en.wikipedia.org/wiki/Indent_style#K.26R_style) braces for everything.

```php
	public function foo() {
		echo 'hi';
	}
```

### AppTable

The core team believes that using AppController and AppView continues to provide significant value to the framework ([thread](https://github.com/cakephp/cakephp/issues/4421#issuecomment-53759646)), but does not feel that hold true for AppTable (or AppEntity). We disagree.

`Table` classes baked by this plugin extend from a parent [App]Table class (conveniently still called `Table` thanks to PHP namespaces.) The [Table](https://github.com/loadsys/CakePHP-Skeleton/tree/master/src/Model/Table/Table.php) class it depends upon is provided from the [Loadsys CakePHP Skeleton](https://github.com/loadsys/CakePHP-Skeleton). As in Cake 2, it's safe to completely ignore this file, provided it is at least present in your app. If you need a Table class baked in which you wish to change this, you must either bake using Cake's default theme or modify the classes after baking them.

Additionally, because our `table.ctp` template assumes that our Skeleton's base Table class will be used, we suppress certain parts of the table baking process. The [App]Table class sets up the primary key, adds the Timestamp and CreatorModifier behaviors, defines two default associations to Creators and Modifiers in the Users table, and suppresses validation for the 5 related fields. It would therefore be redundant and defeat the purpose of the based Table class to bake tables that repeated these steps, so they are skipped.


## Contributing

### Code of Conduct

This project has adopted the Contributor Covenant as its [code of conduct](CODE_OF_CONDUCT.md). All contributors are expected to adhere to this code. [Translations are available](http://contributor-covenant.org/).

### Reporting Issues

Please use [GitHub Isuses](https://github.com/loadsys/CakePHP-LoadsysTheme/issues) for listing any known defects or issues.

### Development

When developing this plugin, please fork and issue a PR for any new development.


## License ##

[MIT](https://github.com/loadsys/CakePHP-LoadsysTheme/blob/master/LICENSE.md)


## Copyright ##

[Loadsys Web Strategies](http://www.loadsys.com) 2016
