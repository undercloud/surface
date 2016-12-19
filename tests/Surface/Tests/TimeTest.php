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
        $zone   = $time->zone();

        $offset  = $time->offset();
        $from    = $time->from('-05:00');
        $fromSec = $time->from(-5 * 3600);

        echo 'TimeZone: '    . $zone    . PHP_EOL;
        echo 'TimeOffset: '  . $offset  . PHP_EOL;
        echo 'TimeFrom: '    . $from    . PHP_EOL;
        echo 'TimeFromSec: ' . $fromSec . PHP_EOL;

        $this->assertEquals($zone, $default);
        $this->assertEquals($offset, 3600);
    }
}