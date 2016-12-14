<?php
namespace Surface;

/**
 * Connection module
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Connection
{
    /**
     * Set whether a client disconnect should abort script execution
     *
     * @param bool $mode value
     *
     * @return null
     */
    public function ignoreAbort($mode)
    {
        ignore_user_abort($mode);
    }

    /**
     * Check if ignoreAbort is setted to true
     *
     * @return boolean
     */
    public function isAbortIgnored()
    {
        return ignore_user_abort();
    }

    /**
     * Get connection status
     *
     * @return int
     */
    public function getStatus()
    {
        return connection_status();
    }

    /**
     * Check if connection alive
     *
     * @return boolean
     */
    public function isNormal()
    {
        return connection_status() === CONNECTION_NORMAL;
    }

    /**
     * Check timeout
     *
     * @return boolean
     */
    public function isTimeout()
    {
        return in_array(connection_status(), [CONNECTION_TIMEOUT, 3], true);
    }

    /**
     * Check if connection aborted
     *
     * @return boolean
     */
    public function isAborted()
    {
        return in_array(connection_status(), [CONNECTION_ABORTED, 3], true);
    }
}