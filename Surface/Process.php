<?php
namespace Surface;

class Process
{
	private $root;

	public function __construct($root)
	{
		$this->root = $root;
	}
	
	public function user()
	{
		return get_current_user();
	}
	
	public function uid()
	{
		return getmyuid();
	}
	
	public function gid()
	{
		return getmygid();
	}
	
	public function pid()
	{
		return getmypid();
	}
	
	public function inode()
	{
		return getmyinode();
	}
	
	public function timeout($sec == null)
	{
		if (false === set_time_limit($sec)) {
		
		}
	}
	
	public function sleep($sec)
	{
		sleep($sec);
	}
	
	public function msleep($msec)
	{
		return usleep($msec * 1000);
	}
	
	public function wait($time)
	{
		if (is_numeric($time)) {
			$timestamp = (int) $time;
		} else {
			$timestamp = strtotime($time);
			
			if (false === $timestamp) {
				
			}
		}
	
		if (false === time_sleep_until($timestamp)) {
			
		}
	}
	

}
?>