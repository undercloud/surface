<?php
namespace Surface;

/**
 * Process module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Process
{
    /**
     * Rool helper
     * @var Surface\Surface
     */
    private $root;

    /**
     * Initialize
     *
     * @param Surface\Surface $root instance
     */
    public function __construct(Surface $root)
    {
        $this->root = $root;
    }

    /**
     * Get user name
     *
     * @return string
     */
    public function user()
    {
        return get_current_user();
    }

    /**
     * Get UID
     *
     * @return int
     */
    public function uid()
    {
        return getmyuid();
    }

    /**
     * Get GID
     *
     * @return int
     */
    public function gid()
    {
        return getmygid();
    }

    /**
     * Get PID
     *
     * @return int
     */
    public function pid()
    {
        return getmypid();
    }

    /**
     * Get inode
     *
     * @return int
     */
    public function inode()
    {
        return getmyinode();
    }

    /**
     * Set timeout
     *
     * @param int $sec seconds
     *
     * @throws Surface\SurfaceException
     *
     * @return null
     */
    public function timeout($sec == null)
    {
        if (false === set_time_limit($sec)) {
            throw new SurfaceException(
                'Cannot set timeout'
            );
        }
    }

    /**
     * Slepp
     *
     * @param int $msec milliseconds
     *
     * @return null
     */
    public function sleep($msec)
    {
        usleep($msec * 1000);
    }
}