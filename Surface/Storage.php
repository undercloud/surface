<?php
namespace Surface;

class Storage
{
	public function free($root)
	{
		return disk_free_space($root);
	}

	public function total($root)
	{
		return disk_total_space($root);
	}
}
?>