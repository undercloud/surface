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
}