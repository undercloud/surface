<?php
namespace Surface;
/**
 * System module
 *
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class System
{
    /**
     * Get SAPI name
     *
     * @return string
     */
    public function sapi()
    {
        return php_sapi_name();
    }

    /**
     * Check is CLI mode
     *
     * @return boolean
     */
    public function isCli()
    {
        return 'cli' === $this->sapi();
    }

    /**
     * Check is HTTP mode
     *
     * @return boolean
     */
    public function isHttp()
    {
        return !$this->isCli();
    }

    /**
     *  Get OS
     *
     * @return string
     */
    public function os()
    {
        return php_uname('s');
    }

    /**
     * Get host
     *
     * @return string
     */
    public function host()
    {
        return php_uname('n');
    }

    /**
     * Get architecture
     *
     * @return string
     */
    public function arch()
    {
        return php_uname('m');
    }

    /**
     * Get server ip
     *
     * @return string
     */
    public function ip()
    {
        return getenv('SERVER_ADDR');
    }

    /**
     * Get server software
     *
     * @return string
     */
    public function software()
    {
        return getenv('SERVER_SOFTWARE');
    }

    /**
     * Get gateway
     *
     * @return string
     */
    public function gateway()
    {
        return getenv('GATEWAY_INTERFACE');
    }

    /**
     * Get protocol
     *
     * @return string
     */
    public function protocol()
    {
        return getenv('SERVER_PROTOCOL');
    }

    /**
     * Get port
     *
     * @return int
     */
    public function port()
    {
        return (int) getenv('SERVER_PORT');
    }

    /**
     * Get system load average
     *
     * @return int
     */
    public function load()
    {
        return (int) sys_getloadavg()[0];
    }

    /**
     * Write message to system log
     *
     * @param string $msg      log message
     * @param int    $priority log level
     *
     * @throws SurfaceException
     *
     * @return void
     */
    public function log($msg, $priority = LOG_NOTICE)
    {
        if (false === syslog($priority, $msg)) {
            throw new SurfaceException(
                'Cannot write message to system log'
            );
        }
    }

    /**
     * Check if system is 32 bit
     *
     * @return boolean
     */
    public function is32bit()
    {
        return PHP_INT_SIZE === 4;
    }

    /**
     * Check if system is 64 bit
     *
     * @return boolean
     */
    public function is64bit()
    {
        return PHP_INT_SIZE === 8;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $sapi     = $this->sapi();
        $arch     = $this->arch();
        $software = $this->software();
        $host     = $this->host();
        $port     = $this->port();
        $ip       = $this->ip();
        $load     = $this->load();
        $cli      = $this->isCli() ? 'true' : 'false';
        $http     = $this->isHttp() ? 'true' : 'false';
        $gateway  = $this->gateway();
        $os       = $this->os();
        $protocol = $this->protocol();
        $is32bit  = $this->is32bit() ? 'true' : 'false';
        $is64bit  = $this->is64bit() ? 'true' : 'false';

        return (
            "├── System
             │  ├── SAPI:       {$sapi}
             │  ├── Arch:       {$arch}
             │  ├── Software:   {$software}
             │  ├── Host:       {$host}
             │  ├── Port:       {$port}
             │  ├── IP:         {$ip}
             │  ├── Load(%):    {$load}
             │  ├── Is CLI:     {$cli}
             │  ├── Is HTTP:    {$http}
             │  ├── Gateway:    {$gateway}
             │  ├── OS:         {$os}
             │  ├── Protocol:   {$protocol}
             │  ├── 32 bit:     {$is32bit}
             │  └── 64 bit:     {$is64bit}"
        );
    }
}
