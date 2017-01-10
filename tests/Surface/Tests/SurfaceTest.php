<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class SurfaceTest extends PHPUnit_Framework_TestCase
{
    public function testDump()
    {
        echo (new Surface)->dump();
    }
}