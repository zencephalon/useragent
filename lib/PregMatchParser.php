<?php


    namespace Sail\UserAgent;

    Class PregMatchParser extends ParserAbstract
    {

        /**
         * components of the useragent string
         * @var string
         */
        protected $platform, $os, $engine, $feature, $compatible;
        
        
        // browser and version
        protected $browser, $version;
        
        
        function __construct($ua) {
            parent::__construct($ua);
            $this->parse();
        }
        
        
        // get the browser info
        function getBrowserInfo( boolean $to_array ){
        }

        // get the browser
        function getBrowser(){
            $this->parsePlatform();
            return $this->browser;
        }

        // get the version
        function getVersion(){
            return $this->version;
        }
        
        // get the Operating System
        function getOS(){
            return $this->os;
        }

        // get the Operating System
        function getPlatform(){
            $this->parse();
            return $this->platform;
        }

        // parse the ua string
        protected function parse(){
            
            // already parsed
            if( $this->platform )
                return;

            preg_match_all( "#\(.*?\)|[^\s]*/[^\s]*#", $this->ua, $m );

            $this->platform       = $m[0][0];
            $this->os             = $m[0][1];
            $this->engine         = $m[0][2];
            $this->feature        = $m[0][3];
            $this->compatible     = array_slice( $m[0], 4 );

        }
        
        protected function parsePlatform(){
            
            // already parsed
            if( $this->browser )
                return;
            
            list($this->browser,$this->version) = explode( "/", $this->platform );
            
        }


    }