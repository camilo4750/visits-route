<?php

namespace App\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Entities\Visit\VisitEntity;
use App\Interfaces\Repositories\Visit\VisitRepositoryInterface;
use Illuminate\Support\Collection;

class VisitRepository implements VisitRepositoryInterface
{
    public function store(VisitNewDto $dto): static
    {
        VisitEntity::query()->insert([
            'name' => $dto->name,
            'email' => $dto->email,
            'latitude' => $dto->latitude,
            'longitude' => $dto->longitude,
            'created_at' => now(),
        ]);

        return $this;
    }
}