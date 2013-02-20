<?php

class Sail_UserAgentTest extends PHPUnit_Framework_TestCase {

    // ua obj
    protected $ua;
    
    protected $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17";
    
    // setup 
    public function setup(){
        $this->ua = new UserAgent( $this->useragent );
    }

    // test getUA
    public function testGetUA(){
        $useragent = $this->ua->getUA();
        $this->assertTrue( $useragent === $this->user_agent );
    }

    // test setUA
    public function testSetUA(){
        $useragent = $this->ua->setUA("test");
        $this->assertTrue( "test" === $this->user_agent );
    }
    
    // test setUA
    public function testToString(){
        $useragent = $this->ua;
        $this->assertTrue( $useragent === $this->user_agent );
    }
    
    
}
