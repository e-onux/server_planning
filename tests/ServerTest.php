<?php
/**
 * User: emironuk
 * Date: 28.04.2019
 */

use Server\Planning\Server;
use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    public function testExceptionOnNegativeValues()
    {
        $this->expectExceptionMessage('Values must be positive integer!');

        new Server(-1,1,1);
        new Server(1,-1,1);
        new Server(1,1,-1);
    }

    public function testSubPositiveResult()
    {
        $server = new Server(1,1,1);
        $this->assertInstanceOf(
            Server::class,
            $server->sub( new Server(2,2,2), new Server(1,1,1))
        );
    }

    public function testSubNegativeResult()
    {
        $server = new Server(1,1,1);
        $this->assertFalse(
            $server->sub( new Server(1,1,1), new Server(2,2,2))
        );
    }
}
