<?php
/**
 * javanile/ipqueue (v0.0.1).
 */

if (preg_match('/^www\.', $_SERVER['HTTP_HOST'])) {
    return require_once __DIR__.'/public/index.php';
}

use Javanile\IpQueue\IpQueueApp;

$app = new IpQueueApp(getallheaders(), $_SERVER);

echo $app->run();
