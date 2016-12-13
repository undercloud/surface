<?php
/**
 * Time module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Time
{
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

    public function offset()
    {
        return timezone_offset_get();
    }

    public function from($offset)
    {
        return timezone_name_from_abbr('GMT', $offset);
    }
}