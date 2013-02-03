<?php


namespace Sail\UserAgent;


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

class UserAgent
{


    /**
     * User Agent
     * @var string UA 
     */
    protected $parser;



    /**
     * Set the useragent
     * @param string $ua
     */
    public function __construct( ParserAbstract $parser ){
        $this->parser = $parser;
    }



    /**
     * Get all the browser information
     * @param boolean $to_array false to get the result as object, true as array
     */
    public function getBrowserInfo( $to_array = true ){
        $this->parser->getBrowserInfo( $to_array );
    }
    
    
    
    /**
     * Get the browser name
     */
    public function getBrowser(){
        return $this->parser->getBrowser();
    }

    
    
    /**
     * Get the os name
     */
    public function getVersion(){
        return $this->parser->getVersion();
    }



    /**
     * Get the os name
     */
    public function getOS(){
        return $this->parser->getOS();

    }



    /**
     * Return true if is a mobile device
     */
    public function isMobile(){
        return $this->parser->isMobile();
    }



    /**
     * Return the platform type, for example iPad, iPhone, Macintosh
     */
    public function getPlatform(){
        return $this->parser->getPlatform();
    }


    /**
     *  get UA
     */
    public function getUA(){
        return $this->parser->getUA();
    }

    
    /**
     *  set UA
     */
    public function setUA( string $ua ){
        $this->parser->setUA( $ua );
    }
    
}

// -- end
