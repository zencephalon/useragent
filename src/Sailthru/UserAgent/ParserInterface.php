<?php

namespace Sailthru\UserAgent;

Interface ParserInterface
{

    // set the useragent
    public function setUA(string $ua);

    // get the useragent
    public function getUA();

    // get the browser info
    public function getBrowserInfo(boolean $to_array);

    // get the browser
    public function getBrowser();

    // get the version
    public function getVersion();

    // get the Operating System
    public function getOS();

    // get the Operating System
    public function getPlatform();
}
