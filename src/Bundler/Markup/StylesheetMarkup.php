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
}