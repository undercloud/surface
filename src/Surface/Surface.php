<?php
namespace Surface;
/**
 * Module manager
 *
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
     * @var System
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
     * Get env variable
     *
     * @param string $key name
     *
     * @return mixed
     */
    public function get($key)
    {
        return getenv($key);
    }

    /**
     * Set env variable
     *
     * @param string $key   key
     * @param mixed  $value value
     *
     * @throws SurfaceException
     */
    public function set($key, $value)
    {
        if (!putenv($key .'=' . $value)) {
            throw SurfaceException(
                sprintf('Cannot set value %s for %s', $value, $key)
            );
        }
    }

    /**
     * Module access
     *
     * @param string $method module
     * @param array  $args   list
     *
     * @throws SurfaceException
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        $modules = array_keys(get_object_vars($this));
        if (in_array($method, $modules)) {
            return $this->load($method);
        } else {
            throw new SurfaceException(sprintf(
                'Module %s does not exists',
                $method
            ));
        }
    }

    /**
     * Dump modules info
     *
     * @param array $modules list
     *
     * @return string
     */
    public function dump(array $modules = null)
    {
        if (null === $modules) {
            $modules = array_keys(get_object_vars($this));
        }

        $echo = [];
        foreach ($modules as $module) {
            $echo []= $this->load($module)->dump();
        }

        return implode(PHP_EOL, $echo);
    }
}