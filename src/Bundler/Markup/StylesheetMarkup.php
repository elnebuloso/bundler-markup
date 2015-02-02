<?php
namespace Bundler\Markup;

/**
 * Class StylesheetMarkup
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class StylesheetMarkup extends AbstractMarkup {

    /**
     * @return string
     */
    public function getFilename() {
        return $this->getBundlerDirectory() . '/stylesheet.php';
    }

    /**
     * @return string
     */
    public function getCacheFilename() {
        return $this->getBundlerDirectory() . '/stylesheet.cache.php';
    }

    /**
     * @param string $packageName
     * @return string
     */
    public function getMarkup($packageName) {
        $markup = array();

        foreach($this->getFiles($packageName) as $file) {
            $markup[] = '<link rel="stylesheet" href="' . $file . '" />';
        }

        return trim(implode(PHP_EOL, $markup));
    }
}