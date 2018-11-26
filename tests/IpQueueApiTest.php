<?php

namespace Javanile\IpQueue\Tests;

use Javanile\IpQueue\IpQueueApi;
use PHPUnit\Framework\TestCase;

class IpQueueApiTest extends TestCase
{
    public function testGetApi()
    {
        $api = new IpQueueApi(
            [ 'Host' => 'test.ipqueue.com' ],
            [ 'REQUEST_METHOD' => 'GET' ]
        );

        $this->assertEquals($api->run(), "");
    }
}
