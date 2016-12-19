<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class SystemTest extends PHPUnit_Framework_TestCase
{
    public function testSystemStack()
    {
        $sys = (new Surface)->system();

        $sapi    = $sys->sapi();
        $os      = $sys->os();
        $host    = $sys->host();
        $arch    = $sys->arch();
        $version = $sys->version();
        $load    = $sys->load();

        echo 'SystemSAPI: '       . $sapi    . PHP_EOL;
        echo 'SystemOS: '         . $os      . PHP_EOL;
        echo 'SystemHost: '       . $host    . PHP_EOL;
        echo 'SystemArch: '       . $arch    . PHP_EOL;
        echo 'SystemPHPVersion: ' . $version . PHP_EOL;
        echo 'SystemLoad: '       . $load    . PHP_EOL;

        $this->assertTrue($sys->isCli());
        $this->assertFalse($sys->isHttp());
        $this->assertTrue($sys->is('>=5.5.9'));

        $sys->log('Well Done!');
    }
}