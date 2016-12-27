<?php
namespace Surface;
/**
 * Exception
 *
 * @package  Surface
 * @author   undercloud <lodashes@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/undercloud/surface
 */

use Exception;

class SurfaceException extends Exception
{
    /**
     * Initialize
     *
     * @param string         $message  error message
     * @param code           $code     error code
     * @param Exception|null $previous exception
     */
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}