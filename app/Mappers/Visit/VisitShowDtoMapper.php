<?php

namespace App\Mappers\Visit;

use App\Dto\Visit\VisitShowDto;
use App\Mappers\BaseMapper;

class VisitShowDtoMapper extends BaseMapper
{
    protected function getNewDto(): VisitShowDto
    {
        return new VisitShowDto();
    }

    public function createFromDbRecord($visit): VisitShowDto
    {
        $dto = new VisitShowDto();
        $dto->name = $visit->name;
        $dto->email = $visit->email;
        $dto->latitude = $visit->latitude;
        $dto->longitude = $visit->longitude;
        $dto->createdAt = $visit->created_at;
        return $dto;
    }
}