<?php

namespace  App\Mappers\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Mappers\BaseMapper;
use Illuminate\Http\Request;

class VisitNewDtoMapper extends BaseMapper
{
    protected function getNewDto(): VisitNewDto
    {
        return new VisitNewDto();
    }

     public function createFromRequest(Request $request): VisitNewDto
    {
        $dto = new VisitNewDto();
        $dto->name = $request->get('name');
        $dto->email = $request->get('email');
        $dto->latitude = $request->get('latitude');
        $dto->longitude = $request->get('longitude');
        return $dto;
    }
}