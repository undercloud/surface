<?php
namespace Surface;

class Surface
{
	public $config;
	public $memory;
	public $scope;
	public $utils;

	public function __construct()
	{
		$this->config = new Config($this);
		$this->memory = new Memory($this);
		$this->scope  = new Scope($this);
		$this->utils  = new Utils($this);
	}
}
?>