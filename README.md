#Sail\UserAgent

Install with composer:
``` json
    {
        "require": {
            "sail/useragent": "1.0.*"
        },
        "repositories": [{
            "type": "vcs",
            "url": "https://github.com/zencephalon/useragent"
        }]
    }
```

create an index.php file:
``` php

<?php

require __DIR__ . "/vendor/autoload.php";

use Sailthru\UserAgent;
use Sailthru\UserAgent\Parser\SailParser;

// test chrome
$useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17";
test($useragent, "chrome 24");

// test explorer
$useragent = "Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2; .NET CLR 3.0.04506.30)";
test($useragent, "explorer 7");
        
// test explorer
$useragent = "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; GTB7.4; InfoPath.2; SV1; .NET CLR 3.3.69573; WOW64; en-US)";
test($useragent, "explorer 7");
        
function test( $useragent, $test ){
    
    echo "<h3>$test</h3>----------------------------<br>";

    $parser = new SailParser( $useragent );
    $ua = new UserAgent( $parser );

    echo $ua;
    echo "<br>";

    echo "<br>Browser: ";
    echo $ua->getBrowser();

    echo " v";
    echo $ua->getVersion();

    echo "<br>Is mobile: ";
    echo $ua->isMobile() ? "YES" : "NO";

    echo "<br>";
    if( $ua->getBrowser() == "MSIE" && $ua->getVersion() < 8 ){
        echo "browser not supported";  
    }
    else{
        echo "browser supported";
    }
    
    echo "<br>is internet explorer 8 ";
    if( $ua->getBrowser() == "Internet Explorer" && preg_match( "/^8/", $ua->getVersion() ) ){
        echo "YES";
    }
    else{
        echo "NO";
    }
}

```
