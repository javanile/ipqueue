<?php
/**
 * javanile/ipqueue (v0.0.1).
 */
declare(strict_types=1);

if (preg_match('/^(www\.|ipqueue\.com)/', $_SERVER['HTTP_HOST'])) {
    return require_once __DIR__.'/public/index.php';
}

require_once __DIR__.'/vendor/autoload.php';

use Javanile\IpQueue\IpQueueApi;

$api = new IpQueueApi(getallheaders(), $_SERVER);

echo $api->run();
