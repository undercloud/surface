<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ProcessTest extends PHPUnit_Framework_TestCase
{
    public function testProcessStack()
    {
        $process = (new Surface)->process();

        $timeout = 10;
        $process->timeout($timeout);
        $this->assertEquals(
            $timeout,
            $process->timeout()
        );

        $process->sleep(500);
    }
}