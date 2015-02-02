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
}