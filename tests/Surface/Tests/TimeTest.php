<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class TimeTest extends PHPUnit_Framework_TestCase
{
    public function testTimeStack()
    {
        $time = (new Surface)->time();

        $default = 'Europe/Berlin';
        $time->zone($default);
        $zone = $time->zone();
        $offset  = $time->offset();

        $this->assertEquals($zone, $default);
        $this->assertEquals($offset, 3600);
    }
}