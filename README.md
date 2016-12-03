# surface

##todo
locale 
timezone 


	public function ignoreAbort($mode)
	{
		ignore_user_abort($mode);
	}

	public function isAbortIgnored()
	{
		return ignore_user_abort();
	}

	public function getStatus()
	{
		return connection_status();
	}

	public function isNormal()
	{
		return connection_status() === CONNECTION_NORMAL;
	}

	public function isTimeout()
	{
		retrun  in_array(connection_status(), [CONNECTION_TIMEOUT, 3], true);
	}

	public function isAborted()
	{
		return in_array(connection_status(), [CONNECTION_ABORTED, 3], true);
	}
  
  public function noop()
	{
		return function ($value = null) {
			return $value;
		};
	}

	public function normalizeCallback($callback)
	{
		if ($callback instanceof Closure) {
			return $callback;
		}

		if (false !== strpos($callback, '::')) {
			return explode('::', $callback, 2);
		}

		return $callback;
	}
  
  public static function toBytes($val)
    {
        if(empty($val)) return 0;

        preg_match('#([0-9]+)[\s]*([a-z]+)#i', $val, $matches);

        $last = '';
        if(isset($matches[2])){
            $last = $matches[2];
        }

        if(isset($matches[1])){
            $val = (int) $matches[1];
        }

        switch (strtolower($last)) {
            case 'g':
            case 'gb':
                $val *= 1024;
            case 'm':
            case 'mb':
                $val *= 1024;
            case 'k':
            case 'kb':
                $val *= 1024;
        }

        return (int) $val;
    }

	function toBoolean($val)
	{
	    static $map = [
	    	'on'    => true, 
	    	'true'  => true, 
	    	'off'   => false, 
	    	'false' => false
	    ];

	    return @($map[strtolower($val)] ?: (bool)$val);
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
		if (is_array($interface)) {
			$thisis = $this;
			$map = array_map(function ($i) use ($thisis) { return $thisis->hasInterface($i); }, $interface);
		
			return $this->root->utils->allIs($map, true);
		}

		return interface_exists($interface);
	}
	
	public function traits()
	{
		return get_declared_traits();
	}
	
	public function hasTrait($trait)
	{
		if (is_array($trait)) {
			$thisis = $this;
			$map = array_map(function ($t) use ($thisis) { return $thisis->hasTrait($t); }, $trait);
		
			return $this->root->utils->allIs($map, true);
		}

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
