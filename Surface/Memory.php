<?php
namespace Surface;

class Memory
{
	private $root;

	public function __construct($root)
	{
		$this->root = $root;
	}
	
	public function used($real_usage = false)
	{
		return memory_get_usage($real_usage);
	}
	
	public function peak($real_usage = false)
	{
		return memory_get_peak_usage($real_usage);
	}
	
	public function limit($value)
	{
		return $this->root->config->set('memory_limit', $value);
	}
}
?>