<?php

namespace mindplay\spatch;

/**
 * This result type delivers a 303 See Other (e.g. for post-redirect-get pattern)
 */
class Redirect implements Deliverable
{
    /**
     * @var string redirection URL
     */
    public $url;

    /**
     * @param string $url the URL to redirect to
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function deliver()
    {
        header('HTTP/1.0 303 See Other');
        header('Location: ' . $this->url);
    }
}
