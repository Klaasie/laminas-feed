<?php

/**
 * @see       https://github.com/laminas/laminas-feed for the canonical source repository
 * @copyright https://github.com/laminas/laminas-feed/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-feed/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Feed\Reader\Extension\WellFormedWeb;

use Laminas\Feed\Reader\Extension;

/**
* @category Laminas
* @package Laminas_Feed_Reader
*/
class Entry extends Extension\AbstractEntry
{
    /**
     * Get the entry comment Uri
     *
     * @return string|null
     */
    public function getCommentFeedLink()
    {
        $name = 'commentRss';
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $data = $this->xpath->evaluate('string(' . $this->getXpathPrefix() . '/wfw:' . $name . ')');

        if (!$data) {
            $data = null;
        }

        $this->data[$name] = $data;

        return $data;
    }

    /**
     * Register Slash namespaces
     *
     * @return void
     */
    protected function registerNamespaces()
    {
        $this->xpath->registerNamespace('wfw', 'http://wellformedweb.org/CommentAPI/');
    }
}
