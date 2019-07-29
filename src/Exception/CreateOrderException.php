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
     */
    public function __construct(string $errorMessage)
    {
        parent::__construct($errorMessage);
    }
}
