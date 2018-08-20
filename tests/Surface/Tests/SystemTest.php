<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class SystemTest extends PHPUnit_Framework_TestCase
{
    public function testSystemStack()
    {
        $sys = (new Surface)->system();

        $this->assertTrue($sys->isCli());
        $this->assertFalse($sys->isHttp());

        $sys->log('Well Done!');
    }
}