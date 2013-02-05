<?php


    namespace Sail\UserAgent;

    Interface ParserInterface
    {

        // set the useragent
        function setUA( string $ua );

        // get the useragent
        function getUA();
        
        // get the browser info
        function getBrowserInfo( boolean $to_array );

        // get the browser
        function getBrowser();

        // get the version
        function getVersion();
        
        // get the Operating System
        function getOS();

        // get the Operating System
        function getPlatform();

    }