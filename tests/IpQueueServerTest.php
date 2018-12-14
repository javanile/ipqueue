<?php

namespace Javanile\IpQueue\Tests;

use Javanile\IpQueue\IpQueueServer;
use PHPUnit\Framework\TestCase;

class IpQueueServerTest extends TestCase
{
    public function testGetApi()
    {
        $api = new IpQueueServer(
            [ 'REQUEST_METHOD' => 'GET' ],
            [ 'Host' => 'test.ipqueue.com' ]
        );

        $this->assertEquals($api->run(), "");
    }
}
