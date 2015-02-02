# bundler-markup

[![Build Status](https://img.shields.io/travis/elnebuloso/bundler/master.svg?style=flat-square)](https://travis-ci.org/elnebuloso/bundler)
[![Software License](https://img.shields.io/packagist/l/elnebuloso/bundler.svg?style=flat-square)](LICENSE)

markup renderer for bundler

```php
$stylesheetMarkup = new StylesheetMarkup();
$stylesheetMarkup->setDevelopment(true);
$stylesheetMarkup->setMinified(true);
$stylesheetMarkup->setVersionized(true);

echo $stylesheetMarkup->getMarkup('stylesheetFoo');
```

```php
$javascriptMarkup = new JavascriptMarkup();
$javascriptMarkup->setDevelopment(true);
$javascriptMarkup->setMinified(true);
$javascriptMarkup->setVersionized(true);

echo $javascriptMarkup->getMarkup('javascriptFoo');
```