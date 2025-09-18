<?php

namespace App\Mappers\Visit;

use App\Dto\Visit\VisitUpdateDto;
use App\Mappers\BaseMapper;
use Illuminate\Http\Request;

class VisitUpdateDtoMapper extends BaseMapper
{
    protected function getNewDto(): VisitUpdateDto
    {
        return new VisitUpdateDto();
    }

    public function createFromRequest(Request $request): VisitUpdateDto
    {
        $dto = new VisitUpdateDto();
        $dto->name = $request->get('name');
        $dto->email = $request->get('email');
        $dto->latitude = $request->get('latitude');
        $dto->longitude = $request->get('longitude');
        return $dto;
    }
}