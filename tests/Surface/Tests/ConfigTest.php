<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    private $config;

    public function __construct()
    {
        $this->config = (new Surface)->config();
    }

    public function testReadAll()
    {

    }
}