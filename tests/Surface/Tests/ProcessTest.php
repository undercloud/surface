<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ProcessTest extends PHPUnit_Framework_TestCase
{
    public function testProcessStack()
    {
        $process = (new Surface)->process();

        $user      = $process->user();
        $uid       = $process->uid();
        $gid       = $process->gid();
        $pid       = $process->pid();
        $inode     = $process->inode();
        $started   = $process->started();
        $startedAt = $process->started('d/m/Y H:i:s');
        $uptime    = $process->uptime();

        echo 'ProcessUser: '      . $user      . PHP_EOL;
        echo 'ProcessUID: '       . $uid       . PHP_EOL;
        echo 'ProcessGID: '       . $gid       . PHP_EOL;
        echo 'ProcessPID: '       . $pid       . PHP_EOL;
        echo 'ProcessINODE: '     . $inode     . PHP_EOL;
        echo 'ProcessStartedTS: ' . $started   . PHP_EOL;
        echo 'ProcessStartedAt: ' . $startedAt . PHP_EOL;
        echo 'Uptime(sec): '      . $uptime    . PHP_EOL;

        $timeout = 10;
        $process->timeout($timeout);
        $this->assertEquals(
            $timeout,
            $process->timeout()
        );

        $process->sleep(500);
    }
}