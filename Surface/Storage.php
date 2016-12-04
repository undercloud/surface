<?php
namespace Surface;

/**
 * Storage module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Storage
{
    /**
     * Get disk free space
     *
     * @param string $root path
     *
     * @return int size in bytes
     */
    public function free($root)
    {
        return disk_free_space($root);
    }

    /**
     * Get disk total space
     *
     * @param string $root path
     *
     * @return int size in bytes
     */
    public function total($root)
    {
        return disk_total_space($root);
    }

    /**
     * Returns the path of the temporary directory
     *
     * @return string
     */
    public function temp()
    {
        return sys_get_temp_dir();
    }
}