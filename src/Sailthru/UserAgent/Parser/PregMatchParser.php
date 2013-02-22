<?php

namespace Sailthru\UserAgent\Parser;
use Sailthru\UserAgent\ParserAbstract;

Class PregMatchParser extends ParserAbstract
{

    /**
     * components of the useragent string
     * @var string
     */
    protected $platform;
    protected $os;
    protected $engine;
    protected $feature;
    protected $compatible;
    
    // browser and version
    protected $browser;
    protected $version;

    public function __construct($ua)
    {
        parent::__construct($ua);
        $this->parse();
    }

    // get the browser info
    public function getBrowserInfo(\boolean $to_array)
    {
        
    }

    // get the browser
    public function getBrowser()
    {
        $this->parsePlatform();
        return $this->browser;
    }

    // get the version
    public function getVersion()
    {
        return $this->version;
    }

    // get the Operating System
    public function getOS()
    {
        return $this->os;
    }

    // get the Operating System
    public function getPlatform()
    {
        $this->parse();
        return $this->platform;
    }
    
    public function isMobile(){
        $this->parse();
        return $this->is_mobile;
    }

    // parse the ua string
    protected function parse()
    {

        // already parsed
        if ($this->platform) {
            return;
        }
            

        preg_match_all("#\(.*?\)|[^\s]*/[^\s]*#", $this->ua, $match);

        $this->platform     = $match[0][0];
        $this->is_mobile    = true;
        $this->os           = $match[0][1];
        $this->engine       = $match[0][2];
        $this->feature      = $match[0][3];
        $this->compatible   = array_slice($match[0], 4);
    }

    protected function parsePlatform()
    {

        // already parsed
        if ($this->browser) {
            return;
        }

        list($this->browser, $this->version) = explode("/", $this->platform);
    }
}
