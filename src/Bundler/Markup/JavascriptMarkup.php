<?php
namespace Bundler\Markup;

/**
 * Class JavascriptMarkup
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class JavascriptMarkup extends AbstractMarkup {

    /**
     * @return string
     */
    public function getFilename() {
        return $this->getBundlerDirectory() . '/javascript.php';
    }

    /**
     * @return string
     */
    public function getCacheFilename() {
        return $this->getBundlerDirectory() . '/javascript.cache.php';
    }

    /**
     * @param string $packageName
     * @return string
     */
    public function getMarkup($packageName) {
        $markup = array();

        foreach($this->getFiles($packageName) as $file) {
            $markup[] = '<script src="' . $file . '"></script>';
        }

        return trim(implode(PHP_EOL, $markup));
    }
}