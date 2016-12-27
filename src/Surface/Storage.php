<?php
namespace Surface;
/**
 * Storage module
 *
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
     * @param string  $root     path
     * @param boolean $humanize format output
     *
     * @return int size in bytes
     */
    public function free($root, $humanize = false)
    {
        $space = disk_free_space($root);

        return $humanize ? Utils::roundBytes($space) : $space;
    }

    /**
     * Get disk total space
     *
     * @param string  $root     path
     * @param boolean $humanize format output
     *
     * @return int size in bytes
     */
    public function total($root, $humanize = false)
    {
        $space =  disk_total_space($root);

        return $humanize ? Utils::roundBytes($space) : $space;
    }

    /**
     * Returns the path of the temporary directory
     *
     * @return string
     */
    public function tmp()
    {
        return sys_get_temp_dir();
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $root = reset(explode(DIRECTORY_SEPARATOR, __DIR__));
        if (!$root) {
            $root = '/';
        }

        $total = $this->total($root, true);
        $free = $this->free($root, true);
        $tmp = $this->tmp();

        return (
            "└── Storage
                ├── Total: {$total}
                ├── Free: {$free}
                └── Tmp: {$tmp}"
        );
    }
}