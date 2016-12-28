<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class StorageTest extends PHPUnit_Framework_TestCase
{
    public function testStorageStack()
    {
        $storage = (new Surface)->storage();
    }
}