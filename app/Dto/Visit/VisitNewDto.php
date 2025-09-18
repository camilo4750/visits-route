<?php

namespace App\Dto\Visit;

use App\Dto\BaseDto;

class VisitNewDto extends BaseDto
{
    public string $name;

    public string $email;

    public float $latitude;
    public float $longitude;
}