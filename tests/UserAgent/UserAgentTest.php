<?php

use Sailthru\UserAgent;
use Sailthru\UserAgent\Parser\SailParser;

class Sail_UserAgentTest extends PHPUnit_Framework_TestCase {

    // ua obj
    protected $ua;

    protected $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17";

    // setup 
    public function setup(){

        $parser = new SailParser( $this->useragent );
        $this->ua = new UserAgent( $parser );

    }

    // test getUA
    public function testGetUA(){
        $this->assertTrue( $this->ua->getUA() == $this->useragent );
    }

    // test toString
    public function testToString(){
        $this->assertTrue( $this->ua == $this->useragent );
    }
    
    // test getbrowser
    public function testGetBrowser(){
        $this->assertTrue( $this->ua->getBrowser() == "Chrome" );
    }
    
    
}
