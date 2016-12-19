<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    public function testConnectionStack()
    {
        $conn = (new Surface)->connection();
        
        $this->assertFalse($conn->isAbortIgnored());
        
        $conn->ignoreAbort(true);
        
        $this->assertTrue($conn->isAbortIgnored());
        $this->assertTrue($conn->isNormal());
        $this->assertFalse($conn->isAborted());
        $this->assertFalse($conn->isTimeout());
        
    }
}