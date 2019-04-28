<?php
/**
 * User: emironuk
 * Date: 27.04.2019
 */

namespace Server\Planning;



class Server
{
    public $cpu;
    public $ram;
    public $hdd;

    /**
     * Server constructor.
     * @param $cpu
     * @param $ram
     * @param $hdd
     * @throws \Exception
     */
    function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = $this->isPositive($cpu);
        $this->ram = $this->isPositive($ram);
        $this->hdd = $this->isPositive($hdd);
    }

    /**
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function isPositive($value)
    {
        if ($value >= 0) {
            return $value;
        } else {
            throw new \Exception("Values must be positive integer!");
        }
    }

    /**
     * @param Server $a
     * @param Server $b
     * @return bool|Server
     */
    public function sub(Server $a, Server $b)
    {
        $cpu = $a->cpu - $b->cpu;
        $ram = $a->ram - $b->ram;
        $hdd = $a->hdd - $b->hdd;
        if ($cpu >= 0 && $ram >= 0 && $hdd >= 0) {
            return new Server($cpu, $ram, $hdd);
        } else {
            return false;
        }
    }
}