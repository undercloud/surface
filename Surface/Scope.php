<?php
namespace Surface;

/**
 * Scope module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Scope
{
    /**
     * Get declared classes
     *
     * @return array
     */
    public function classes()
    {
        return get_declared_classes();
    }

    /**
     * Check class exists
     *
     * @param  string  $class    name
     * @param  boolean $autoload whether or not to call __autoload by default
     *
     * @return boolean
     */
    public function hasClass($class, $autoload = true)
    {
        return class_exists($class, $autoload);
    }

    /**
     * Get declared interfaces
     *
     * @return array
     */
    public function interfaces()
    {
        return get_declared_interfaces();
    }

    /**
     * Check interface exists
     *
     * @param string  $interface name
     * @param boolean $autoload  whether or not to call __autoload by default
     *
     * @return boolean
     */
    public function hasInterface($interface, $autoload = true)
    {
        return interface_exists($interface, $autoload);
    }

    /**
     * Get declared traits
     *
     * @return array
     */
    public function traits()
    {
        return get_declared_traits();
    }

    /**
     * Check trait exists
     *
     * @param string  $trait    name
     * @param boolean $autoload whether or not to call __autoload by default
     *
     * @return boolean
     */
    public function hasTrait($trait, $autoload = true)
    {
        return trait_exists($trait, $autoload);
    }

    public function extensions()
    {
        return get_loaded_extensions();
    }

    public function hasExtension($name)
    {
        return extension_loaded($name);
    }

    public function constants($categorize = false)
    {
        return get_defined_constants($categorize);
    }

    public function hasConstant($name)
    {
        return defined($name);
    }

    public function functions($name)
    {
        if ($name) {
            return get_extension_funcs($name);
        }

        $fn = get_defined_functions();

        return array_merge(
            $fn['internal'],
            isset($fn['user']) ? $fn['user'] : []
        );
    }

    public function hasFunction($name)
    {
        return function_exists($name);
    }

    public function included()
    {
        return get_included_files();
    }

    public function isIncluded($path)
    {
        return in_array($path, $this->included());
    }

    public function getIncludePath()
    {
        return explode(PATH_SEPARATOR, get_include_path());
    }

    public function setIncludePath(array $paths)
    {
        return set_include_path(implode(PATH_SEPARATOR, $paths));
    }

    public function restoreIncludePath()
    {
        return restore_include_path();
    }
}