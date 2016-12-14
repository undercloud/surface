<?php
namespace Surface;

/**
 * Helper
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Utils
{
    /**
     * Cast value to int
     *
     * @param mixed $val in bytes
     *
     * @return int
     */
    public static function toBytes($val)
    {
        if (empty($val)) {
            return 0;
        }

        preg_match('#([0-9]+)[\s]*([a-z]+)#i', $val, $matches);

        $last = '';
        if (isset($matches[2])) {
            $last = $matches[2];
        }

        if (isset($matches[1])) {
            $val = (int) $matches[1];
        }

        switch (strtolower($last)) {
            case 'g':
            case 'gb':
                $val *= 1024;
            case 'm':
            case 'mb':
                $val *= 1024;
            case 'k':
            case 'kb':
                $val *= 1024;
        }

        return (int) $val;
    }

    /**
     * Cast value to bool
     *
     * @param mixed $val boolean
     *
     * @return bool
     */
    public static function toBoolean($val)
    {
        static $map = [
            'on'    => true,
            'true'  => true,
            'off'   => false,
            'false' => false
        ];

        return @($map[strtolower($val)] ?: (bool)$val);
    }
}