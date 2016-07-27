<?php
namespace Surface;

/*use SurfaceException;*/

class Config
{
	public function get($key = null)
	{
		if (null === $key) {
			return ini_get_all();
		} else {
			return ini_get($key);
		}
	}
	
	public function from($extension)
	{
		return ini_get_all($extension);
	}
	
	public function set($key, $value)
	{
		if (false === ini_set($key, $value)) {
			
		}
	}
	
	public function load($ini, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL)
	{
		if (false === ($parsed = parse_ini_file($ini, $process_sections, $scanner_mode))) {
		
		}
		
		return $parsed;
	}
	
	public function parse($ini, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL)
	{
		if (false === ($parsed = parse_ini_string($ini, $process_sections, $scanner_mode))) {
		
		}
		
		return $parsed;
	}
	
	public function source()
	{
		return php_ini_loaded_file();
	}
	
	public function included()
	{
		return array_filter(explode(',', (string)php_ini_scanned_files()));
	}
	
	public function restore($key)
	{
		return ini_restore($key);
	}
}
?>