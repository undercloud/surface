<?php
namespace Surface;

/**
 * Locale module
 *
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */
class Locale
{
    /**
     * Set locale
     *
     * @param string $key   name
     * @param mixed  $value item
     *
     * @throws SurfaceException
     *
     * @return void
     */
    public function set($key, $value)
    {
        $key = 'LC_' . strtoupper($key);
        $constant = constant($key);

        if (false === setlocale($constant, $value)) {
            throw new SurfaceException('Cannot set locale for %s', $key);
        }
    }

    /**
     * Get summary
     *
     * @throws SurfaceException
     *
     * @return string
     */
    public function dump()
    {
        $this->set('all', 'en_US.utf8');

         return (
            "├── Locale
             │  └── Current: en_US"
        );
    }
}
