<?php
namespace Surface;
/**
 * Time module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */

use DateTime;
use DateTimeZone;

class Time
{
    /**
     * Get or set timezone name
     *
     * @param string $name timezone
     *
     * @return null|string
     */
    public function zone($name = null)
    {
        if ($name) {
            if (false === @date_default_timezone_set($name)) {
                throw new SurfaceException(
                    error_get_last()['message']
                );
            }
        } else {
            return date_default_timezone_get();
        }
    }

    /**
     * Get timezone offset
     *
     * @return integer
     */
    public function offset()
    {
        return (new DateTimeZone($this->zone()))
            ->getOffset(
                new DateTime('now', new DateTimeZone('GMT'))
            );
    }

    /**
     *  Get timezone name from offset
     *
     * @param string|int $offset integer or human +/-00:00 format
     * @param int        $isdst  daylight saving time indicator
     *
     * @return string
     */
    public function from($offset, $isdst = 0)
    {
        if (preg_match('~([\+\-])?(\d\d):(\d\d)~', $offset, $match)) {
            $offset = (3600 * (int) $match[2]) + (60 * (int) $match[3]);

            if ('-' === $match[1]) {
                $offset *= -1;
            }
        }

        return timezone_name_from_abbr('', $offset, $isdst);
    }
}