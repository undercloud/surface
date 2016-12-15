<?php
namespace Surface;

/**
 * Config module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */

use Closure;

class Config
{
    /**
     * Get all config settings
     * 
     * @param string $section name
     *
     * @return array
     */
    public function all()
    {
        return ini_get_all(null, false);
    }

    /**
     * Get settings value
     *
     * @param string         $key     name
     * @param Closure|string $process instance
     *
     * @return mixed
     */
    public function get($key, $process = null)
    {
        $value = ini_get($key);
        if ($process === 'bool') {
            return Utils::toBoolean($value);
        } else if ($process == 'bytes') {
            return Utils::toBytes($value);
        } else if ($process instanceof Closure) {
            return call_user_func($process, $value);
        }
        
        return $value;
    }

    /**
     * Get settings for extension
     *
     * @param string $extension name
     *
     * @return array
     */
    public function from($extension)
    {
        return ini_get_all($extension, false);
    }

    /**
     * Set settings value
     *
     * @param string $key   name
     * @param mixed  $value setup
     *
     * @throws Surface\SurfaceException
     *
     * @return null
     */
    public function set($key, $value)
    {
        if (false === ini_set($key, $value)) {
            throw new SurfaceException(
                'Cannot set config for ' . $key
            );
        }
    }

    /**
     * Restore settings value
     *
     * @param string $key name
     *
     * @return null
     */
    public function restore($key)
    {
        ini_restore($key);
    }

    /**
     * Load and parse ini file
     *
     * @param string  $path             to ini file
     * @param boolean $process_sections flag
     * @param int     $scanner_mode     constant
     *
     * @throws Surface\SurfaceException
     *
     * @return array
     */
    public function load($path, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL)
    {
        if (false === ($parsed = parse_ini_file(
                $path,
                $process_sections,
                $scanner_mode))
        ) {
            throw SurfaceException(
                'Cannot parse ini file at %s',
                $path
            );
        }

        return $parsed;
    }

    /**
     * Parse ini from string
     *
     * @param string  $ini              config string
     * @param boolean $process_sections flag
     * @param int     $scanner_mode     value
     *
     * @throws Surface\SurfaceException
     *
     * @return array
     */
    public function parse($ini, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL)
    {
        if (false === ($parsed = parse_ini_string(
                $ini,
                $process_sections,
                $scanner_mode))
        ) {
            throw new SurfaceException(
                'Cannot parse ini string'
            );
        }

        return $parsed;
    }

    /**
     * Get config path
     *
     * @return string
     */
    public function source()
    {
        return php_ini_loaded_file();
    }

    /**
     * Get list of included configs
     *
     * @return array
     */
    public function included()
    {
        return array_filter(explode(',' . PHP_EOL, trim((string)php_ini_scanned_files())));
    }
}