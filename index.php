<?php
/**
 * javanile/ipqueue (v0.0.1)
 */

define('IPQUEUE_HOST', 'www.ipqueue.com');

if ($_SERVER['HTTP_HOST'] == IPQUEUE_HOST) {
    return require_once __DIR__.'/public/index.php';
}

$app = new IpQueueApp($_SERVER);

echo $app->run();
