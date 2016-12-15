<?php
namespace Surface;
/**
 * Module manager
 *
 * @category PHP Environment Manager
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 * 
 * @method Config     config()
 * @method Connection connection()
 * @method Memory     memory()
 * @method Process    process()
 * @method Scope      scope()
 * @method Storage    storage()
 * @method System     system()
 * @method Time       time()
 */
class Surface
{
	/**
	 * @var Config
	 */
    private $config;
    
    /**
     * @var Connection
     */
    private $connection;
    
    /**
     * @var Memory
     */
    private $memory;
    
    /**
     * @var Process
     */
    private $process;
    
    /**
     * @var Scope
     */
    private $scope;
    
    /**
     * @var Storage
     */
    private $storage;
    
    /**
     * @var Sustem
     */
    private $system;
    
    /**
     * @var Time
     */
    private $time;

    /**
     * Resolve module
     *
     * @param string $module name
     *
     * @return mixed
     */
    private function load($module)
    {
        if (null === $this->{$module}) {
            $class = 'Surface\\' . ucfirst($module);
            $this->{$module} = new $class($this);
        }
        
        return $this->{$module};
    }

    /**
     * Module access
     *
     * @param string $method module
     * @param array  $args   list
     *
     * @throws Surface\SurfaceException
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        $modules = [
            'config','connection',
            'memory','process',
            'scope','storage',
            'system','time'
        ];

        if (in_array($method, $modules)) {
            return $this->load($method);
        } else {
            throw new SurfaceException(sprintf(
                'Module %s does not exists',
                $method
            ));
        }
    }
}