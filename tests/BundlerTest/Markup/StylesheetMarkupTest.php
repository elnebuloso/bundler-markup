<?php
namespace BundlerTest\Markup;

use Bundler\Markup\StylesheetMarkup;

/**
 * Class StylesheetMarkupTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class StylesheetMarkupTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $configCache;

    /**
     * @var StylesheetMarkup
     */
    private $markup;

    /**
     * @return void
     */
    public function setUp() {
        $this->config = include dirname(__FILE__) . '/../../../.bundler/stylesheet.php';
        $this->configCache = include dirname(__FILE__) . '/../../../.bundler/stylesheet.cache.php';
        $this->markup = new StylesheetMarkup();
    }

    /**
     * @return void
     */
    public function tearDown() {
        $this->markup = null;
    }

    /**
     * @test
     */
    public function test_construct() {
        $this->assertEquals('./.bundler', $this->markup->getBundlerDirectory());
        $this->assertEquals('/', $this->markup->getHost());
        $this->assertFalse($this->markup->getMinified());
        $this->assertFalse($this->markup->getDevelopment());
        $this->assertTrue($this->markup->getVersionized());
    }

    /**
     * @test
     */
    public function test_bundlerDirectory() {
        $expected = uniqid();
        $this->markup->setBundlerDirectory($expected);
        $this->assertEquals($expected, $this->markup->getBundlerDirectory());
    }

    /**
     * @test
     */
    public function test_host() {
        $expected = uniqid();
        $this->markup->setHost($expected);
        $this->assertEquals($expected, $this->markup->getHost());
    }

    /**
     * @test
     */
    public function test_minified() {
        $expected = uniqid();
        $this->markup->setMinified($expected);
        $this->assertEquals($expected, $this->markup->getMinified());
    }

    /**
     * @test
     */
    public function test_development() {
        $expected = uniqid();
        $this->markup->setDevelopment($expected);
        $this->assertEquals($expected, $this->markup->getDevelopment());
    }

    /**
     * @test
     */
    public function test_versionized() {
        $expected = uniqid();
        $this->markup->setVersionized($expected);
        $this->assertEquals($expected, $this->markup->getVersionized());
    }

    /**
     * @test
     */
    public function test_getFilename() {
        $expected = '/foo/stylesheet.php';
        $this->markup->setBundlerDirectory('/foo');
        $this->assertEquals($expected, $this->markup->getFilename());
    }

    /**
     * @test
     */
    public function test_getCacheFilename() {
        $expected = '/bar/stylesheet.cache.php';
        $this->markup->setBundlerDirectory('/bar');
        $this->assertEquals($expected, $this->markup->getCacheFilename());
    }

    /**
     * @test
     */
    public function test_getFilesCached_min_versionized() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(true);

        $result = $this->markup->getFilesCached('stylesheetFoo');
        $expected = array('/css/stylesheetFoo.min.css?v=' . $this->configCache['stylesheetFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function test_getFilesCached_min_not_versionized() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(false);

        $result = $this->markup->getFilesCached('stylesheetFoo');
        $expected = array('/css/stylesheetFoo.min.css');

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function test_getFilesCached_max_versionized() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(false);
        $this->markup->setVersionized(true);

        $result = $this->markup->getFilesCached('stylesheetFoo');
        $expected = array('/css/stylesheetFoo.max.css?v=' . $this->configCache['stylesheetFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function test_getFilesCached_max_not_versionized() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(false);
        $this->markup->setVersionized(false);

        $result = $this->markup->getFilesCached('stylesheetFoo');
        $expected = array('/css/stylesheetFoo.max.css');

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @expectedException \Bundler\Markup\MarkupException
     * @expectedExceptionMessage missing package in bundler cache file
     */
    public function test_getFilesCached_packageNotFound() {
        $this->markup->getFilesCached('foo');
    }

    /**
     * @test
     */
    public function test_getFilesDevelopment() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(true);

        $result = $this->markup->getFilesDevelopment('stylesheetFoo');
        $expected = array(
            '/vendor/twitter/bootstrap/3.1.0/css/bootstrap.css',
            '/vendor/twitter/bootstrap/3.1.0/css/bootstrap-theme.css'
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @expectedException \Bundler\Markup\MarkupException
     * @expectedExceptionMessage missing package in bundler file
     */
    public function test_getFilesDevelopment_packageNotFound() {
        $this->markup->getFilesDevelopment('foo');
    }

    /**
     * @test
     */
    public function test_getFiles() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(true);

        $result = $this->markup->getFiles('stylesheetFoo');
        $expected = array('/css/stylesheetFoo.min.css?v=' . $this->configCache['stylesheetFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function test_getFiles_development() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(true);

        $result = $this->markup->getFiles('stylesheetFoo');
        $expected = array(
            '/vendor/twitter/bootstrap/3.1.0/css/bootstrap.css',
            '/vendor/twitter/bootstrap/3.1.0/css/bootstrap-theme.css'
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function test_getMarkup() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(true);

        $this->assertEquals('<link rel="stylesheet" href="/css/stylesheetFoo.min.css?v=' . $this->configCache['stylesheetFoo']['md5'] . '" />', $this->markup->getMarkup('stylesheetFoo'));
    }
}