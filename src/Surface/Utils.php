<?php
namespace Surface;
/**
 * Helper
 *
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Utils
{
    /**
     * Convert bytes to human readable
     *
     * @param mixed $val size in bytes
     *
     * @return string
     */
    public static function roundBytes($val)
    {
        $precision = 2;
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        foreach ($units as $unit) {
            if ($val >= 1024 && $unit != 'YB') {
                $val = ($val / 1024);
            } else {
                return round($val, $precision) . $unit;
            }
        }
    }

    /**
     * Casr value to int
     *
     * @param mixed $val in numeric
     *
     * @return int
     */
    public static function toNumeric($val)
    {
        return self::toBytes($val, 1000);
    }

    /**
     * Cast bytes to int
     *
     * @param mixed $val in bytes
     *
     * @return int
     */
    public static function toBytes($val, $base = 1024)
    {
        if (preg_match('~([0-9]+)[\s]*([a-z]+)~i', $val, $matches)) {
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
                $val *= $base;
            case 'm':
            case 'mb':
                $val *= $base;
            case 'k':
            case 'kb':
                $val *= $base;
            }
        } else {
            $val = 0;
        }

        return $val;
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
        $val = strtolower($val);

        $map = [
            'on'    => true,
            'true'  => true,
            'off'   => false,
            'false' => false
        ];

        return (isset($map[$val]) ? $map[$val] : (bool) $val);
    }
}