<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
        ['Tests' => __DIR__. "/tests", 'Pages' => __DIR__ . "/pages"]
)->register();