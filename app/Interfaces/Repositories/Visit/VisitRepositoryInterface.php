<?php

namespace App\Interfaces\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Dto\Visit\VisitShowDto;

interface VisitRepositoryInterface
{
    public function store(VisitNewDto $dto): static;

    public function getById(int $id): VisitShowDto|null;
}