<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        $config = (new Surface)->config();
    }

    public function testConfigStack()
    {
        $config = (new Surface)->config();

        $all = $config->all();
        $from = $config->from('session');
        $config->set('session.cookie_path', '/go');
        $config->restore('session.cookie_path');

        $memory = $config->get('post_max_size', 'bytes');
        $errors = $config->get('display_errors', 'bool');
    }

    public function testInclude()
    {
        $config = (new Surface)->config();

        $included = $config->included();
        $source = $config->source();
    }
}