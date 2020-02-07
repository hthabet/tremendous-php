<?php
declare(strict_types=1);

namespace Tremendous\Exception;

use Exception;

class CreateOrderException extends Exception
{

    /**
     * CreateOrderException constructor.
     *
     * @param string $errorMessage
     * @param Exception|null $previous
     */
    public function __construct(string $errorMessage, $previous = null)
    {
        parent::__construct($errorMessage, 0, $previous);
    }
}
