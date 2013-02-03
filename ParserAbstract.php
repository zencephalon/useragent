<?php

    namespace Sail\UserAgent;

    Abstract Class ParserAbstract implements ParserInterface{


        // ua
        protected $ua;



        function __construct( $ua ) {
            $this->ua = $ua;
        }


        
        // set the useragent
        final function setUA( string $ua ){
            $this->ua = $ua;
        }



        // get the useragent
        final function getUA(){
            return $this->ua;
        }
        

    }
