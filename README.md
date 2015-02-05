# bundler-markup

[![Build Status](https://img.shields.io/travis/elnebuloso/bundler/master.svg?style=flat-square)](https://travis-ci.org/elnebuloso/bundler)
[![Software License](https://img.shields.io/packagist/l/elnebuloso/bundler.svg?style=flat-square)](LICENSE)

markup renderer for bundler

## Requirements

The following versions of PHP are supported by this version.

* PHP 5.3
* PHP 5.4
* PHP 5.5
* PHP 5.6
* HHVM

## Stylesheet Markup rendered by Bundler Stylesheet Config Files

```php
$stylesheetMarkup = new StylesheetMarkup();
$stylesheetMarkup->setHost('./');
$stylesheetMarkup->setDevelopment(true);
$stylesheetMarkup->setMinified(true);
$stylesheetMarkup->setVersionized(true);

echo $stylesheetMarkup->getMarkup('stylesheetFoo');
```

## Javascript Markup rendered by Bundler Javascript Config Files

```php
$javascriptMarkup = new JavascriptMarkup();
$javascriptMarkup->setHost('./');
$javascriptMarkup->setDevelopment(true);
$javascriptMarkup->setMinified(true);
$javascriptMarkup->setVersionized(true);

echo $javascriptMarkup->getMarkup('javascriptFoo');
```