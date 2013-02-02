<?php

namespace Sail;

/**
 *  Sail\UserAgent
 *  --------
 *  Library to get the browser information, including the version, 
 *  the device type, the operating system and more.
 * 
 *  @example 
 *  $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17"
 *  $ua = new \Sail\UserAgent( $useragent );
 *  echo $ua->getBrowser();  // Chrome
 *  echo $ua->getVersion();  // 24.0.1312.56
 *  echo $ua->getPlatform(); // Macintosh
 *
 *  @license MIT
 *  @author Sailthru 
 *  @version 1.0
 */

require __DIR__ . "Sail/UserAgent/Browsers.php";
require __DIR__ . "Sail/UserAgent/OperatingSystem.php";
require __DIR__ . "Sail/UserAgent/Version.php";

class UserAgent 
{

    /**
     * User Agent
     * @var string UA 
     */
    protected $ua;
    

    
    /**
     * Set the useragent
     * @param string $ua
     */
    public function __construct( $ua ){
        
    }



    /**
     * Get all the browser information
     * @param boolean $to_array false to get the result as object, true as array
     */
    public function getBrowserInfo( $to_array = true ){
        
    }
    
    
    
    /**
     * Get the browser name
     */
    public function getBrowser(){
        
    }



    /**
     * Get the os name
     */
    public function getOS(){
        
    }



    /**
     * Return true if is a mobile device
     */
    public function isMobile(){
        
    }



    /**
     * Return the platform type, for example iPad, iPhone, Macintosh
     */
    public function getPlatform(){
        
    }
    


    /**
     * Set the user agent string
     */
    public function setUA( $ua ){
        
    }



    /**
     * Get the user agent string
     */
    public function getUA( $ua ){
        
    }


    
}

// -- end
