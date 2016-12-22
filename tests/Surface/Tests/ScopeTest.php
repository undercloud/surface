<?php
namespace Surface\Tests;

use Surface\Surface;
use PHPUnit_Framework_TestCase;

class ScopeTest extends PHPUnit_Framework_TestCase
{
    public function testClassStack()
    {
        $scope = (new Surface)->scope();

        $classes    = $scope->classes();
        $traits     = $scope->traits();
        $interfaces = $scope->interfaces();

        $this->assertTrue($scope->hasClass('DateTime'));
        $this->assertTrue($scope->hasInterface('DateTimeInterface'));

        echo 'ScopeClasses: [' . implode(', ', array_slice($classes,0,20)) . ', ...]' . PHP_EOL;
        echo 'ScopeTraits: [' . implode(', ', $traits) . ']' . PHP_EOL;
        echo 'ScopeInterfaces: [' . implode(', ', $interfaces) . ']' . PHP_EOL;
    }

    public function testOtherStack()
    {
        $scope = (new Surface)->scope();

        $extensions = $scope->extensions();
        $this->assertTrue($scope->hasExtension('SPL'));
        echo 'ScopeExtensions: [' . implode(', ', $extensions) . ']' . PHP_EOL;

        $functions = $scope->functions();
        $this->assertTrue($scope->hasFunction('array_map'));
        echo 'ScopeFunctions: [' . implode(', ', array_slice($functions,0,20)) . ', ...]' . PHP_EOL;

        $constants = $scope->constants();
        $this->assertTrue($scope->hasConstant('PHP_EOL'));
        echo 'ScopeConstants: [' . implode(', ', array_slice($constants,0,20)) . ', ...]' . PHP_EOL;
    }

    public function testIncludeStack()
    {
        $scope = (new Surface)->scope();

        $included = $scope->included();
        echo 'ScopeIncluded: [' . implode(', ', array_slice($included, 0, 5)) . ', ...]' . PHP_EOL;
        $this->assertTrue($scope->isIncluded($included[0]));

        $scope->addIncludePath('/var/www');
        $includePath = $scope->getIncludePath();
        echo 'ScopeInclidePath: [' . implode(', ', $includePath) . ']' . PHP_EOL;
        $scope->setIncludePath(['/foo','/bar','/baz']);
        $scope->restoreIncludePath();
    }
}