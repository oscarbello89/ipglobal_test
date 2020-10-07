<?php

namespace App\Exception;

/**
 * Class ApiError
 */
class ApiError extends \Exception
{
    /**
     * ApiError constructor.
     *
     * @param string $value
     * @param string $error
     */
    public function __construct(string $value, string $error)
    {
        $message = sprintf('Ningún resultado con "%s". Error: "%s"', $value, $error);

        parent::__construct($message);
    }
}
