<?php

namespace App\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Dto\Visit\VisitShowDto;
use App\Dto\Visit\VisitUpdateDto;
use App\Entities\Visit\VisitEntity;
use App\Interfaces\Repositories\Visit\VisitRepositoryInterface;
use App\Mappers\Visit\VisitShowDtoMapper;

class VisitRepository implements VisitRepositoryInterface
{
    public function getAll(): array
    {
        $visits = VisitEntity::all();
        return $visits->map(function ($visit) {
            return (new VisitShowDtoMapper())->createFromDbRecord($visit);
        })->toArray();
    }

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

    public function getById(int $id): VisitShowDto|null
    {
        $visit = VisitEntity::query()->find($id);
        if (!$visit) {
            return null;
        }
        return (new VisitShowDtoMapper())->createFromDbRecord($visit);
    }

    public function update(VisitUpdateDto $dto, int $id): static
    {
        VisitEntity::query()
            ->where('id', $id)
            ->update([
                'name' => $dto->name,
                'email' => $dto->email,
                'latitude' => $dto->latitude,
                'longitude' => $dto->longitude,
                'updated_at' => now(),
            ]);

        return $this;
    }

    public function destroy(int $id): static
    {
        VisitEntity::query()
            ->where('id', $id)
            ->delete();

        return $this;
    }
}