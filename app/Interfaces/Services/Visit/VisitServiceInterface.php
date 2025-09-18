<?php

namespace App\Interfaces\Services\Visit;

use Illuminate\Http\Request;

interface VisitServiceInterface
{
    public function store(Request $request): void;
}