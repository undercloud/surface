<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class MemoryTest extends PHPUnit_Framework_TestCase
{
    public function testMemoryStack()
    {
        $memory = (new Surface)->memory();

        $used     = $memory->used(false, true);
        $realUsed = $memory->used(true, true);
        $peak     = $memory->peak(false, true);
        $realPeak = $memory->peak(true, true);

        $this->assertGreaterThan(0, $used);
        $this->assertGreaterThan(0, $realUsed);
        $this->assertGreaterThan(0, $peak);
        $this->assertGreaterThan(0, $realPeak);

        echo 'MemoryUsed: '     . $used     . PHP_EOL;
        echo 'MemoryRealUsed: ' . $realUsed . PHP_EOL;
        echo 'MemoryPeak: '     . $peak     . PHP_EOL;
        echo 'MemoryRealPeak: ' . $realPeak . PHP_EOL;

        $memory->limit('10M');
    }
}