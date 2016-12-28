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
     * Get PHP version
     *
     * @param string $extension module
     *
     * @return string
     */
    public function version($extension = null)
    {
        return (
            $extension
            ? phpversion($extension)
            : (
                PHP_MAJOR_VERSION . '.' .
                PHP_MINOR_VERSION . '.' .
                PHP_RELEASE_VERSION
            )
        );
    }

    /**
     * Compare PHP version
     *
     * @param string $version  value
     * @param string $operator compare
     *
     * @return boolean
     */
    public function is($version)
    {
        $regex = '~([<>=!])?(\d{1,2}(\.\d{1,2}(\.\d{1,2})?)?)~';
        if (preg_match($regex, $version, $match)) {
            if (!isset($match[3])) $match[2] .= '.0';
            if (!isset($match[4])) $match[2] .= '.0';

            list($op, $version) = array_slice($match, 1);

            if (!$op) {
                $op = '=';
            }

            return (bool) version_compare($this->version(), $version, $op);
        }

        return false;
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
        $load = 0;
        if (!function_exists('sys_getloadavg')) {
            if (stristr(PHP_OS, 'win')) {
                $wmi = new COM("Winmgmts://");
                $server = $wmi->execquery(
                    "SELECT LoadPercentage FROM Win32_Processor"
                );

                $cpu_num = 0;
                $load_total = 0;

                foreach ($server as $cpu) {
                    $cpu_num++;
                    $load_total += $cpu->loadpercentage;
                }

                $load = round($load_total / $cpu_num);
            }
        } else {
            $sys_load = sys_getloadavg();
            $load = $sys_load[0];
        }

        return (int) $load;
    }

    /**
     * Write message to system log
     *
     * @param string $msg      log message
     * @param int    $priority log level
     *
     * @throws SurfaceException
     *
     * @return null
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
     * Get summary
     *
     * @return string
     */
    public function dump()
    {
        $version = $this->version();
        $sapi = $this->sapi();
        $arch = $this->arch();
        $software = $this->software();
        $host = $this->host();
        $port = $this->port();
        $ip = $this->ip();
        $load = $this->load();
        $cli = $this->isCli() ? 'true' : 'false';
        $http = $this->isHttp() ? 'true' : 'false';
        $gateway = $this->gateway();
        $os = $this->os();
        $protocol = $this->protocol();

        return (
            "├── System
             │  ├── Verison: {$version}
             │  ├── SAPI: {$sapi}
             │  ├── Arch: {$arch}
             │  ├── Software: {$software}
             │  ├── Host: {$host}
             │  ├── Port: {$port}
             │  ├── IP: {$ip}
             │  ├── Load(%): {$load}
             │  ├── Is CLI: {$cli}
             │  ├── Is HTTP: {$http}
             │  ├── Gateway: {$gateway}
             │  ├── OS: {$os}
             │  └── Protocol: {$protocol}"
        );
    }
}