<?php
namespace Bundler\Markup;

/**
 * Class AbstractMarkup
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
abstract class AbstractMarkup {

    /**
     * @var string
     */
    private $bundlerDirectory;

    /**
     * @var string
     */
    private $host;

    /**
     * @var bool
     */
    private $minified;

    /**
     * @var bool
     */
    private $development;

    /**
     * @var bool
     */
    private $versionized;

    /**
     * @return self
     */
    public function __construct() {
        $this->setBundlerDirectory('./.bundler');
        $this->setHost('/');
        $this->setMinified(false);
        $this->setDevelopment(false);
        $this->setVersionized(true);
    }

    /**
     * @param string $bundlerDirectory
     */
    public function setBundlerDirectory($bundlerDirectory) {
        $this->bundlerDirectory = $bundlerDirectory;
    }

    /**
     * @return string
     */
    public function getBundlerDirectory() {
        return $this->bundlerDirectory;
    }

    /**
     * @param string $host
     */
    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param bool $minified
     */
    public function setMinified($minified) {
        $this->minified = $minified;
    }

    /**
     * @return bool
     */
    public function getMinified() {
        return $this->minified;
    }

    /**
     * @param bool $development
     */
    public function setDevelopment($development) {
        $this->development = $development;
    }

    /**
     * @return bool
     */
    public function getDevelopment() {
        return $this->development;
    }

    /**
     * @param bool $versionized
     */
    public function setVersionized($versionized) {
        $this->versionized = $versionized;
    }

    /**
     * @return bool
     */
    public function getVersionized() {
        return $this->versionized;
    }
}