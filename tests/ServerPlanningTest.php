<?php
/**
 * User: emironuk
 * Date: 27.04.2019
 */

use Server\Planning\Server;
use Server\Planning\ServerPlanning;
use PHPUnit\Framework\TestCase;

class ServerPlanningTest extends TestCase
{
    private $serverPlanning;

    function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        $this->serverPlanning = new ServerPlanning();
        parent::__construct($name, $data, $dataName);
    }

    public function testFailOnCalculateInvalidVMArray()
    {
        $this->expectExceptionMessage("vmArray has at least one item and must be iterable. (ie. array)");
        $this->serverPlanning->calculate($this->generateServer(), []);
        $this->serverPlanning->calculate($this->generateServer(), "invalidArg");
    }

    public function testVMExcessServerCapacity()
    {
        $this->expectExceptionMessage("Server has not enough capacity anymore to provide place for virtual machine.");

        $this->assertEquals(1, $this->serverPlanning->calculate(
            new Server(2, 2, 3),
            [
                new Server(1, 1, 1),
                new Server(1, 1, 1),
                new Server(1, 1, 1)
            ]));
    }

    public function testNoFitVMExist()
    {
        $this->expectExceptionMessage("Server has not enough capacity anymore to provide place for virtual machine.");
        $this->assertEquals(0, $this->serverPlanning->calculate(
            new Server(1, 1, 1),
            [
                new Server(2, 1, 1),
                new Server(2, 1, 1),
                new Server(2, 1, 1)
            ]));
    }

    private function generateServer()
    {
        $cpu = floor(rand(2, 25));
        $ram = floor(rand(8, 128));
        $hdd = floor(rand(5, 50)) * 100;
        return new Server($cpu, $ram, $hdd);
    }

}
