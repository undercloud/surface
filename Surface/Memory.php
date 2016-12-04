<?php
namespace Surface;

/**
 * Memory module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Memory
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
     * Get used memory
     *
     * @param boolean $real_usage flag
     *
     * @return int
     */
    public function used($real_usage = false)
    {
        return memory_get_usage($real_usage);
    }

    /**
     * Get peak memory usage
     *
     * @param boolean $real_usage flag
     *
     * @return int
     */
    public function peak($real_usage = false)
    {
        return memory_get_peak_usage($real_usage);
    }

    /**
     * Limit memory usage
     *
     * @param string $value limit
     *
     * @return null
     */
    public function limit($value)
    {
        return $this->root->config->set('memory_limit', $value);
    }
}