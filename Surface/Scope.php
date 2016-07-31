<?php
namespace Surface;

class Scope
{
	private $root;
	private static $container;

	public function __construct($root)
	{
		$this->root = $root;
		
		if (null == self::$container) {
			self:$container = array(
				'get'    => &$_GET,
				'post'   => &$_POST,
				'server' => &$_SERVER,
				'cookie' => &$_COOKIE
			);
		}
	}

	public function with()
	{
		
	}
	
	public function globals($key)
	{
		return self::$container[$key];
	}
	
	public function classes()
	{
		return get_declared_classes();
	}

	public function hasClass($class)
	{
		if (is_array($class)) {
			$thisis = $this;
			$map = array_map(function ($c) use ($thisis) { return $thisis->hasClass($c); }, $class);
		
			return $this->root->utils->allIs($map, true);
		}
	
		return class_exists($class);
	}
	
	public function interfaces()
	{
		return get_declared_interfaces();
	}
	
	public function hasInterface($interface)
	{
		return interface_exists($interface);
	}
	
	public function traits()
	{
		return get_declared_traits();
	}
	
	public function hasTrait($trait)
	{
		return trait_exists($trait);
	}
	
	public function extensions()
	{
		return get_loaded_extensions();
	}
	
	public function hasExtension($name)
	{
		return extension_loaded($name);
	}
	
	public function get($key = null)
	{
		$get = $this->globals('get');
		
		if (null === $key) {
			return $get;
		}
		
		return $this->root->utils->retrieve($get, $key);
	}
}

?>