<?php
namespace Surface;

class Scope
{
	private $root;

	public function __construct($root)
	{
		$this->root = $root;
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
	
		return class_exists($class, false);
	}
	
	public function interfaces()
	{
		return get_declared_interfaces();
	}
	
	public function hasInterface($interface)
	{
		return interface_exists($interface, false);
	}
	
	public function traits()
	{
		return get_declared_traits();
	}
	
	public function hasTrait($trait)
	{
		return trait_exists($trait, false);
	}
	
	public function extensions()
	{
		return get_loaded_extensions();
	}
	
	public function hasExtension($name)
	{
		return extension_loaded($name);
	}
	
	public function get()
	{
		return $_GET;
	}
	
	public function post()
	{
		return $_POST;
	}
}

?>