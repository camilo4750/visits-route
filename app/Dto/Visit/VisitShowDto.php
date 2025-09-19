<?php

namespace App\Dto\Visit;

use App\Dto\BaseDto;

class VisitShowDto extends BaseDto
{
    public int $id;
    public string $name;

    public string $email;

    public float $latitude;
    public float $longitude;

    public string $createdAt;
}