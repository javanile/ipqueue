<?php

namespace Javanile\IpQueue\Tests;

use Javanile\IpQueue\IpQueueApp;
use PHPUnit\Framework\TestCase;

class IpQueueAppTest extends TestCase
{
    public function testGetApi()
    {
        $app = new IpQueueApp(
            [ 'Host' => 'test.ipqueue.com' ],
            [ 'REQUEST_METHOD' => 'GET' ]
        );

        $this->assertEquals($app->run(), "");
    }
}
