#Sail\UserAgent

Install with composer:
``` json
    {
        "require": {
            "sail/useragent": "1.0.*"
        }
    }
```

create an index.php file:
``` php
<?php

    require __DIR__ . "/vendor/autoload.php";

    use Sail\UserAgent\UserAgent;
    use Sail\UserAgent\PregMatchParser;

    $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17";
    $parser = new PregMatchParser( $useragent );

    $ua = new UserAgent( $parser );

    echo "<br>";
    echo $ua->getUA();

    // -- end
```