<?php
namespace Surface;
/**
 * Time module
 *
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
     * @throws SurfaceException
     *
     * @return null|string
     */
    public function zone($name = null)
    {
        if (0 == func_num_args()) {
            return date_default_timezone_get();
        } else {
            if (false === @date_default_timezone_set($name)) {
                throw new SurfaceException(
                    error_get_last()['message']
                );
            }
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
     * @param bool       $isdst  daylight saving time indicator
     *
     * @throws SurfaceException
     *
     * @return string
     */
    public function from($offset, $isdst = false)
    {
        if (preg_match('~([\+\-])?(\d\d):(\d\d)~', $offset, $match)) {
            $offset = (3600 * (int) $match[2]) + (60 * (int) $match[3]);

            if ('-' === $match[1]) {
                $offset *= -1;
            }
        } else if (!is_numeric($offset)) {
            throw new SurfaceException(
                'Invalid timezone offset %s',
                $offset
            );
        }

        foreach (timezone_abbreviations_list() as $abbr) {
            foreach ($abbr as $city) {
                if ($city['offset'] == $offset and $city['dst'] === $isdst) {
                    return $city['timezone_id'];
                }
            }
        }

        return false;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $zone   = $this->zone();
        $offset = $this->offset();

        return (
            "└── Time
                ├── Zone:   {$zone}
                └── Offset: {$offset}"
        );
    }
}