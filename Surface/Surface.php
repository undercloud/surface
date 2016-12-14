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
 * @method Surface\Config     config()
 * @method Surface\Connection connection()
 * @method Surface\Memory     memory()
 * @method Surface\Process    process()
 * @method Surface\Scope      scope()
 * @method Surface\Storage    storage()
 * @method Surface\System     system()
 * @method Surface\Time       time()
 */
class Surface
{
    private $config;
    private $connection;
    private $memory;
    private $process;
    private $scope;
    private $storage;
    private $system;
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
     * @param string $method [description]
     * @param array  $args   [description]
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