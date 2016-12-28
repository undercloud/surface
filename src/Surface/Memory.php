<?php
namespace Surface;

/**
 * Memory module
 *
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
     * @param boolean $humanize   format output
     *
     * @return int
     */
    public function used($real_usage = false, $humanize = false)
    {
        $usage = memory_get_usage($real_usage);

        return $humanize ? Utils::roundBytes($usage) : $usage;
    }

    /**
     * Get peak memory usage
     *
     * @param boolean $real_usage flag
     * @param boolean $humanize   format output
     *
     * @return int
     */
    public function peak($real_usage = false, $humanize = false)
    {
        $peak = memory_get_peak_usage($real_usage);

        return $humanize ? Utils::roundBytes($peak) : $peak;
    }

    /**
     * Limit memory usage
     *
     * @param string $value limit
     *
     * @return null
     */
    public function limit($value = null)
    {
        return $this->root->config()->set('memory_limit', $value);
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $used = $this->used(false, true);
        $usedReal = $this->used(true, true);
        $peak = $this->peak(false, true);
        $peakReal = $this->peak(true, true);
        $limit = $this->root->config()->get('memory_limit');

        return (
            "├── Memory
             │  ├── Used: {$used}
             │  ├── Used(real): {$usedReal}
             │  ├── Peak: {$peak}
             │  ├── Peak(real): {$peakReal}
             │  └── Limit: {$limit}"
        );
    }
}