<?php
namespace Surface;

class Utils
{
	public function allIs(array $list, $value)
	{
		if (count(array_unique($list)) == 1) {
			return (reset($list) === $value);
		}
		
		return false;
	}
	
	public function retrieve(array $array, $key)
	{
		if (isset($array[$key])) {
			return $array[$key];
		}
	}
}
?>