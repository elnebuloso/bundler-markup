<?php
namespace BundlerTest\Markup;

use Bundler\Markup\JavascriptMarkup;

/**
 * Class JavascriptMarkupTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class JavascriptMarkupTest extends \PHPUnit_Framework_TestCase
{

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
    public function setUp()
    {
        $this->config = include dirname(__FILE__) . '/../../../.bundler/javascript.php';
        $this->configCache = include dirname(__FILE__) . '/../../../.bundler/javascript.cache.php';
        $this->markup = new JavascriptMarkup();
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        $this->markup = null;
    }

    /**
     * @test
     */
    public function testConstruct()
    {
        $this->assertEquals('./.bundler', $this->markup->getBundlerDirectory());
        $this->assertEquals('/', $this->markup->getHost());
        $this->assertFalse($this->markup->getMinified());
        $this->assertFalse($this->markup->getDevelopment());
        $this->assertTrue($this->markup->getVersionized());
    }

    /**
     * @test
     */
    public function testBundlerDirectory()
    {
        $expected = uniqid();
        $this->markup->setBundlerDirectory($expected);
        $this->assertEquals($expected, $this->markup->getBundlerDirectory());
    }

    /**
     * @test
     */
    public function testHost()
    {
        $expected = uniqid();
        $this->markup->setHost($expected);
        $this->assertEquals($expected, $this->markup->getHost());
    }

    /**
     * @test
     */
    public function testMinified()
    {
        $expected = uniqid();
        $this->markup->setMinified($expected);
        $this->assertEquals($expected, $this->markup->getMinified());
    }

    /**
     * @test
     */
    public function testDevelopment()
    {
        $expected = uniqid();
        $this->markup->setDevelopment($expected);
        $this->assertEquals($expected, $this->markup->getDevelopment());
    }

    /**
     * @test
     */
    public function testVersionized()
    {
        $expected = uniqid();
        $this->markup->setVersionized($expected);
        $this->assertEquals($expected, $this->markup->getVersionized());
    }

    /**
     * @test
     */
    public function testGetFilename()
    {
        $expected = '/foo/javascript.php';
        $this->markup->setBundlerDirectory('/foo');
        $this->assertEquals($expected, $this->markup->getFilename());
    }

    /**
     * @test
     */
    public function testGetCacheFilename()
    {
        $expected = '/bar/javascript.cache.php';
        $this->markup->setBundlerDirectory('/bar');
        $this->assertEquals($expected, $this->markup->getCacheFilename());
    }

    /**
     * @test
     */
    public function testGetFilesCachedMinVersionized()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(true);

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/site/www/builds/javascriptFoo.min.js?v=' . $this->configCache['javascriptFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function testGetFilesCachedMinNotVersionized()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(false);

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/site/www/builds/javascriptFoo.min.js');

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function testGetFilesCachedMaxVersionized()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(false);
        $this->markup->setVersionized(true);

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/site/www/builds/javascriptFoo.max.js?v=' . $this->configCache['javascriptFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function testGetFilesCachedMaxNotVersionized()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(false);
        $this->markup->setVersionized(false);

        $result = $this->markup->getFilesCached('javascriptFoo');
        $expected = array('/site/www/builds/javascriptFoo.max.js');

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @expectedException \Bundler\Markup\MarkupException
     * @expectedExceptionMessage missing package in bundler cache file
     */
    public function testGetFilesCachedPackageNotFound()
    {
        $this->markup->getFilesCached('foo');
    }

    /**
     * @test
     */
    public function testGetFilesDevelopment()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(true);

        $result = $this->markup->getFilesDevelopment('javascriptFoo');
        $expected = array(
            '/site/www/vendor/jquery/jquery/1.11.0/jquery-1.11.0.js',
            '/site/www/vendor/twitter/bootstrap/3.1.0/js/bootstrap.js'
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @expectedException \Bundler\Markup\MarkupException
     * @expectedExceptionMessage missing package in bundler file
     */
    public function testGetFilesDevelopmentPackageNotFound()
    {
        $this->markup->getFilesDevelopment('foo');
    }

    /**
     * @test
     */
    public function testGetFiles()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(true);

        $result = $this->markup->getFiles('javascriptFoo');
        $expected = array('/site/www/builds/javascriptFoo.min.js?v=' . $this->configCache['javascriptFoo']['md5']);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function testGetMarkup()
    {
        $this->markup->setBundlerDirectory('./.bundler');
        $this->markup->setHost('/');
        $this->markup->setDevelopment(false);
        $this->markup->setMinified(true);
        $this->markup->setVersionized(true);

        $expected = '<script src="/site/www/builds/javascriptFoo.min.js?v=' . $this->configCache['javascriptFoo']['md5'] . '"></script>';
        $this->assertEquals($expected, $this->markup->getMarkup('javascriptFoo'));
    }
}
