<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class LocaleTest extends PHPUnit_Framework_TestCase
{
    public function testLocale()
    {
        $locale = (new Surface)->locale();

        $locale->set('all', 'en_US.utf8');
    }
}