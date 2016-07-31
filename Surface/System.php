<?php
namespace Surface;

class System
{
	public function sapi()
	{
		return php_sapi_name();
	}

	public function os()
	{
		return php_uname('s');
	}
	
	public function host()
	{
		return php_uname('n');
	}
	
	public function arch()
	{
		return php_uname('m');
	}
	
	public function version($extension = null)
	{
		return phpversion($extension);
	}
	
	public function is($version, $operator = 'eq')
	{
		return version_compare($this->version(), $version, $operator);
	}
	
	public function load()
	{
		if (stristr(PHP_OS, 'win')) {
			$wmi = new COM("Winmgmts://");
			$server = $wmi->execquery("SELECT LoadPercentage FROM Win32_Processor");

			$cpu_num = 0;
			$load_total = 0;
            
			foreach($server as $cpu){
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

	public function sys($msg, $priority = LOG_NOTICE)
	{
		if (false === syslog($msg, $priority)) {

		}
	}
}
?>