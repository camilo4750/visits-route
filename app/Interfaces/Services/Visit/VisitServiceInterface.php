<?php

namespace App\Interfaces\Services\Visit;

use App\Dto\Visit\VisitShowDto;
use Illuminate\Http\Request;

interface VisitServiceInterface
{
    public function store(Request $request): void;
    public function getById(int $id): VisitShowDto|null;
}