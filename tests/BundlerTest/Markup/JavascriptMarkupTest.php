<?php
namespace BundlerTest\Markup;

use Bundler\Markup\JavascriptMarkup;

/**
 * Class JavascriptMarkupTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class JavascriptMarkupTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $configCache;

    /**
     * @var JavascriptMarkup
     */
    private $markup;

    /**
     * @return void
     */
    public function setUp() {
        $this->config = include dirname(__FILE__) . '/../../../.bundler/javascript.php';
        $this->configCache = include dirname(__FILE__) . '/../../../.bundler/javascript.cache.php';
        $this->markup = new JavascriptMarkup();
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
        $expected = '/foo/javascript.php';
        $this->markup->setBundlerDirectory('/foo');
        $this->assertEquals($expected, $this->markup->getFilename());
    }

    /**
     * @test
     */
    public function test_getCacheFilename() {
        $expected = '/bar/javascript.cache.php';
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

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/js/javascriptFoo.min.js?v=' . $this->configCache['javascriptFoo']['md5']);

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

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/js/javascriptFoo.min.js');

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

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/js/javascriptFoo.max.js?v=' . $this->configCache['javascriptFoo']['md5']);

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

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/js/javascriptFoo.max.js');

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

        $result = $this->markup->getFilesDevelopment('javascriptFoo');
        $expected = array(
            '/vendor/jquery/jquery/1.11.0/jquery-1.11.0.js',
            '/vendor/twitter/bootstrap/3.1.0/js/bootstrap.js'
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

        $result = $this->markup->getFiles('javascriptFoo');
        $expected = array('/js/javascriptFoo.min.js?v=' . $this->configCache['javascriptFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function test_getFiles_development() {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(true);

        $result = $this->markup->getFiles('javascriptFoo');
        $expected = array(
            '/vendor/jquery/jquery/1.11.0/jquery-1.11.0.js',
            '/vendor/twitter/bootstrap/3.1.0/js/bootstrap.js'
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

        $this->assertEquals('<script src="/js/javascriptFoo.min.js?v=' . $this->configCache['javascriptFoo']['md5'] . '"></script>', $this->markup->getMarkup('javascriptFoo'));
    }
}