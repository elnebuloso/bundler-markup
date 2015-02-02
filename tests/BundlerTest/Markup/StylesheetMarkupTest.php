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
     * @var StylesheetMarkup
     */
    private $markup;

    /**
     * @return void
     */
    public function setUp() {
        $this->markup = new StylesheetMarkup();
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
}