<?php

    $loader = require dirname(__DIR__) . '/lib/autoload.php';
    $loader->add('AppName', __DIR__.'/../src/');

    require dirname(__DIR__) . "/lib/";
    