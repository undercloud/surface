<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class StorageTest extends PHPUnit_Framework_TestCase
{
    public function testStorageStack()
    {
        $storage = (new Surface)->storage();

        $tmp = $storage->tmp();

        echo 'StorageTmp: ' . $tmp . PHP_EOL;

        if (stristr(PHP_OS, 'Linux')) {
            $free = $storage->free('/');
            $total = $storage->total('/');

            echo 'StorageFree: '  . $free . PHP_EOL;
            echo 'StorageTotal: ' . $total . PHP_EOL;
        }
    }
}