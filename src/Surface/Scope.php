<?php
namespace Surface;
/**
 * Scope module
 *
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Scope
{
    /**
     * Get PHP version
     *
     * @param string $extension module
     *
     * @return string
     */
    public function version($extension = null)
    {
        return (
            $extension
            ? phpversion($extension)
            : (
                PHP_MAJOR_VERSION . '.' .
                PHP_MINOR_VERSION . '.' .
                PHP_RELEASE_VERSION
            )
        );
    }

    /**
     * Compare PHP version
     *
     * @param string $version  value
     * @param string $operator compare
     *
     * @return boolean
     */
    public function is($version)
    {
        $regex = '~([<>=!]+)?(\d{1,2}(\.\d{1,2}(\.\d{1,2})?)?)~';
        if (preg_match($regex, $version, $match)) {
            if (!isset($match[3])) $match[2] .= '.0';
            if (!isset($match[4])) $match[2] .= '.0';

            list($op, $version) = array_slice($match, 1);

            if (!$op) {
                $op = '=';
            }

            return (bool) version_compare($this->version(), $version, $op);
        }

        return false;
    }

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
     * @param string  $class    name
     * @param boolean $autoload whether or not to call __autoload by default
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

    /**
     * Get loaded extensions
     *
     * @return array
     */
    public function extensions()
    {
        return get_loaded_extensions();
    }

    /**
     * Check if extension loaded
     *
     * @param string $name extension name
     *
     * @return boolean
     */
    public function hasExtension($name)
    {
        return extension_loaded($name);
    }

    /**
     * Get defined constants
     *
     * @param boolean $categorize by modules
     *
     * @return array
     */
    public function constants($categorize = false)
    {
        return get_defined_constants($categorize);
    }

    /**
     * Check constant exists
     *
     * @param string $name of constant
     *
     * @return boolean
     */
    public function hasConstant($name)
    {
        return defined($name);
    }

    /**
     * Get defined functions
     *
     * @param string|null $name of module
     *
     * @return array
     */
    public function functions($name = null)
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

    /**
     * Check function exists
     *
     * @param string $name of function
     *
     * @return boolean
     */
    public function hasFunction($name)
    {
        return function_exists($name);
    }

    /**
     * Get included files
     *
     * @return array
     */
    public function included()
    {
        return get_included_files();
    }

    /**
     * Check if path included
     *
     * @param string $path to file
     *
     * @return boolean
     */
    public function isIncluded($path)
    {
        return in_array($path, $this->included());
    }

    /**
     * Get include path
     *
     * @return array
     */
    public function getIncludePath()
    {
        return explode(PATH_SEPARATOR, get_include_path());
    }

    /**
     * Set include path
     *
     * @param array $paths to dirs
     *
     * @return null
     */
    public function setIncludePath(array $paths)
    {
        if(false === set_include_path(implode(PATH_SEPARATOR, $paths))){
            throw new SurfaceException(
                'Cannot set include path for %s',
                implode(',', $paths)
            );
        }
    }

    /**
     * Add include path
     *
     * @param string $path to dir
     *
     * @return null
     */
    public function addIncludePath($path)
    {
        $include = $this->getIncludePath();
        $include[] = $path;
        $this->setIncludePath($include);
    }

    /**
     * Restore include path
     *
     * @return null
     */
    public function restoreIncludePath()
    {
        restore_include_path();
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $version    = $this->version();
        $extensions = '[' . implode(', ', $this->extensions()) . ']';
        $classes    = count($this->classes());
        $interfaces = count($this->interfaces());
        $traits     = count($this->traits());
        $functions  = count($this->functions());
        $constants  = count($this->constants());
        $included   = count($this->included());

        return (
            "├── Scope
             │  ├── Verison:    {$version}
             │  ├── Extensions: {$extensions}
             │  ├── Classes:    {$classes}
             │  ├── Interfaces: {$interfaces}
             │  ├── Traits:     {$traits}
             │  ├── Functions:  {$functions}
             │  ├── Constants:  {$constants}
             │  └── Included:   {$included}"
        );
    }
}