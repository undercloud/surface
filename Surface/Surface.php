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
 * @method   Surface\Config  config()
 * @method   Surface\Memory  memory()
 * @method   Surface\Scope   scope()
 * @method   Surface\Storage storage()
 * @method   Surface\Utils   utils()
 */
class Surface
{
	private $config;
	private $memory;
	private $scope;
    private $storge;
	private $utils;

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
            $class = ucfirst($module);
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
        $modules = ['config','memory','scope','storage','utils'];
        if (in_array($method, $modules)) {
            return $this->load('config');
        } else {
            throw new SurfaceException(sprintf(
                'Module %s does not exists',
                $method
            ));
        }
    }
}