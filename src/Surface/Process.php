<?php
namespace Surface;
/**
 * Process module
 *
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Process
{
    /**
     * @var Surface|null
     */
    private $root;

    /**
     * Initialize
     *
     * @param Surface|null $root instance
     */
    public function __construct(Surface $root = null)
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
     * Get or set timeout
     *
     * @param int $sec seconds
     *
     * @throws SurfaceException
     *
     * @return mixed
     */
    public function timeout($sec = null)
    {
        if (0 == func_num_args()) {
            return $this->root->config()->get('max_execution_time');
        } else {
            return $this->root->config()->set('max_execution_time', $sec);
        }
    }

    /**
     * Sleep
     *
     * @param int $msec milliseconds
     *
     * @return void
     */
    public function sleep($msec)
    {
        usleep($msec * 1000);
    }

    /**
     * Get process start time
     *
     * @param string $format value
     *
     * @return float
     */
    public function started($format = null)
    {
        $ts = (int) $_SERVER['REQUEST_TIME_FLOAT'];

        if ($format) {
            return date($format, $ts);
        }

        return $ts;
    }

    /**
     * Get process uptime
     *
     * @return float
     */
    public function uptime()
    {
        return round(microtime(true) - $this->started(), 3);
    }

    /**
     * Get summary
     *
     * @throws SurfaceException
     *
     * @return string
     */
    public function dump()
    {
        $user    = $this->user();
        $uid     = $this->uid();
        $gid     = $this->gid();
        $pid     = $this->pid();
        $inode   = $this->inode();
        $timeout = $this->timeout();
        $uptime  = $this->uptime();

        return (
            "├── Process
             │  ├── User:       {$user}
             │  ├── UID:        {$uid}
             │  ├── GID:        {$gid}
             │  ├── PID:        {$pid}
             │  ├── Inode:      {$inode}
             │  ├── Timeout(s): {$timeout}
             │  └── Uptime(s):  {$uptime}"
        );
    }
}