<?php

namespace App\Interfaces\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use Illuminate\Support\Collection;

interface VisitRepositoryInterface
{
    public function store(VisitNewDto $dto): static;
}