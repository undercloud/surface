<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ScopeTest extends PHPUnit_Framework_TestCase
{
    public function testClassStack()
    {
        $scope = (new Surface)->scope();

        $this->assertTrue($scope->hasClass('DateTime'));
        $this->assertTrue($scope->hasInterface('DateTimeInterface'));
    }

    public function testOtherStack()
    {
        $scope = (new Surface)->scope();

        $this->assertTrue($scope->hasExtension('SPL'));
        $this->assertTrue($scope->hasFunction('array_map'));
        $this->assertTrue($scope->hasConstant('PHP_EOL'));
  }

    public function testIncludeStack()
    {
        $scope = (new Surface)->scope();

        $included = $scope->included();
        $this->assertTrue($scope->isIncluded($included[0]));

        $scope->addIncludePath('/var/www');
        $includePath = $scope->getIncludePath();
        $scope->setIncludePath(['/foo','/bar','/baz']);
        $scope->restoreIncludePath();
    }
}