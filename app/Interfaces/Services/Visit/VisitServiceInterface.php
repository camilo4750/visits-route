<?php

namespace App\Interfaces\Services\Visit;

use App\Dto\Visit\VisitShowDto;
use Illuminate\Http\Request;

interface VisitServiceInterface
{
    public function getAll(): array;

    public function store(Request $request): void;

    public function getById(int $id): VisitShowDto|null;

    public function update(Request $request, int $id): void;

    public function destroy(int $id): void;
}