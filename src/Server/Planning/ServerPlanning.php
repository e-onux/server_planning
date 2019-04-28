<?php
/**
 * User: emironuk
 * Date: 27.04.2019
 */

namespace Server\Planning;


class ServerPlanning
{
    /**
     * @param Server $server
     * @param $vmArray
     * @return int
     * @throws \Exception
     */
    public function calculate(Server $server, $vmArray)
    {
        $result = 0;
        $currentStatus = $server;
        if ($this->is_iterable($vmArray)) {
            foreach ($vmArray as $vm) {
                $currentStatus = $server->sub($currentStatus, $vm);
                if (!empty($currentStatus)) {
                    $result++;
                } else {
                    throw new \Exception("Server has not enough capacity anymore to provide place for virtual machine.");
                }
            }
        }else{
            throw new \Exception("vmArray has at least one item and must be iterable. (ie. array)");
        }
        return $result;
    }

    /**
     * Determine if a variable is iterable.
     *
     * @return bool
     */
    private function is_iterable($var)
    {
        return $var !== null
            && (is_array($var)
                || $var instanceof \Traversable
                || $var instanceof \Iterator
                || $var instanceof \IteratorAggregate
            );
    }
}