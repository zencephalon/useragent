<?php

namespace Sail\UserAgent;

Abstract Class ParserAbstract implements ParserInterface
{

    // ua
    protected $ua;

    public function __construct($ua)
    {
        $this->ua = $ua;
    }

    // set the useragent
    final public function setUA(string $ua)
    {
        $this->ua = $ua;
    }

    // get the useragent
    final public function getUA()
    {
        return $this->ua;
    }
}
