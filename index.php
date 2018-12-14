<?php
/**
 * javanile/ipqueue (v0.0.1).
 */
declare(strict_types=1);

if (preg_match('/^(www\.|ipqueue\.com)/', $_SERVER['HTTP_HOST'])) {
    header('Location: /docs');
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

use Javanile\IpQueue\IpQueueServer;

$server = new IpQueueServer($_SERVER, getallheaders());

echo $server->run();
