# bundler-markup

![abandoned](https://img.shields.io/badge/project-abandoned-red)

markup renderer for bundler

## Requirements

The following versions of PHP are supported by this version.

* PHP 5.4
* PHP 5.5
* PHP 5.6
* PHP 7.0
* HHVM

## Coding Standards

Bundler follows the standards defined in the PSR-0, PSR-1, PSR-2 and PSR-4 documents.

## Installation / Usage

Via Composer

``` json
{
    "require-dev": {
        "elnebuloso/bundler-markup": "~9.0"
    }
}
```

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