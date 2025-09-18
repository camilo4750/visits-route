<?php

namespace App\Interfaces\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Dto\Visit\VisitShowDto;
use App\Dto\Visit\VisitUpdateDto;

interface VisitRepositoryInterface
{
    public function store(VisitNewDto $dto): static;

    public function getById(int $id): VisitShowDto|null;

    public function update(VisitUpdateDto $dto, int $id): static;

    public function destroy(int $id): static;
}