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
    public function __construct($message = null)
    {
        if (func_num_args() > 1) {
            $params = array_slice(func_get_args(), 1);

            $params = array_map(function($item){
                if (is_array($item)) {
                    $item = implode(', ', $item);
                }

                return $item;
            }, $params);

            $message = vsprintf(
                $message,
                $params
            );
        }

        parent::__construct($message);
    }
}