<?php
namespace Surface;
/**
 * Connection module
 *
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
        return (bool) ignore_user_abort();
    }

    /**
     * Get connection status
     *
     * @return string
     */
    public function getStatus()
    {
        if ($this->isNormal()) {
            return 'normal';
        }

        if ($this->isTimeout()) {
            return 'timeout';
        }

        if ($this->isAborted()) {
            return 'aborted';
        }
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

    /**
     * Get connection IP
     *
     * @param string $real flag
     *
     * @return string
     */
    public function ip($real = false)
    {
        if ($real) {
            $keys = [
                'HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED',
                'HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR'
            ];

            foreach ($keys as $key) {
                if($ip = getenv($key)) {
                    return $ip;
                }
            }
        } else {
            return getenv('REMOTE_ADDR');
        }
    }

    /**
     *  Check if connection is secure
     *
     * @return boolean
     */
    public function isSecure()
    {
        return (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] === 'on');
    }

    /**
     *  Get connection port
     *
     * @return int
     */
    public function port()
    {
        return (int) getenv('SERVER_PORT');
    }

    /**
     *  Get connection remote port
     *
     * @return int
     */
    public function remotePort()
    {
        return (int) getenv('REMOTE_PORT');
    }

    /**
     *  Get connection remote host
     *
     * @return string
     */
    public function host()
    {
        return getenv('REMOTE_HOST');
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $status      = $this->getStatus();
        $ignoreAbort = $this->isAbortIgnored() ? 'true' : 'false';
        $ip          = $this->ip();
        $realIp      = $this->ip(true);
        $secure      = $this->isSecure() ? 'true' : 'false';
        $port        = $this->port();
        $remotePort  = $this->remotePort();
        $host        = $this->host();

        return (
            "├── Connection
             │  ├── Status:         {$status}
             │  ├── Ignore Abort:   {$ignoreAbort}
             │  ├── IP:             {$ip}
             │  ├── Real IP:        {$realIp}
             │  ├── Port:           {$port}
             │  ├── Remote Port:    {$remotePort}
             │  ├── Host:           {$host}
             │  └── Secure:         {$secure}"
        );
    }
}
