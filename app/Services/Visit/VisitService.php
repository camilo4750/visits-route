<?php
namespace App\Services\Visit;

use App\Dto\Visit\VisitShowDto;
use App\Interfaces\Repositories\Visit\VisitRepositoryInterface;
use App\Interfaces\Services\Visit\VisitServiceInterface;
use App\Mappers\Visit\VisitNewDtoMapper;
use Illuminate\Http\Request;

class VisitService implements VisitServiceInterface
{

    private $visitRepo;

    public function __construct(VisitRepositoryInterface $visitRepo)
    {
        $this->visitRepo = $visitRepo;
    }
    public function store(Request $request): void
    {
        $dto = (new VisitNewDtoMapper())->createFromRequest($request);
        $this->visitRepo->store($dto);
    }


    public function getById(int $id): VisitShowDto|null
    {
        return $this->visitRepo->getById($id);
    }
}