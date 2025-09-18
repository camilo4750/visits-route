<?php

namespace App\Exceptions\Visit;

use App\Exceptions\BusinessLogicException;

class VisitNotFoundException extends BusinessLogicException
{
    protected $message = 'Visita no encontrada';
    protected $code = 404;

    protected array $errors = [];
}