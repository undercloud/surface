<?php
namespace Surface;

/**
 * System module
 *
 * @category PHP Environment Manager
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

    public function isCli()
    {

    }

    public function isHttp()
    {

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
        return phpversion($extension);
    }

    /**
     * Compare PHP version
     *
     * @param string $version  value
     * @param string $operator compare
     *
     * @return boolean
     */
    public function is($version, $operator = 'eq')
    {
        return version_compare($this->version(), $version, $operator);
    }

    /**
     * Get system load average
     *
     * @return int
     */
    public function load()
    {
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

            $load = round($load_total/$cpu_num);
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
}