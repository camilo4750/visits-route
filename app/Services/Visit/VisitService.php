<?php
namespace App\Services\Visit;

use App\Dto\Visit\VisitShowDto;
use App\Exceptions\Visit\VisitNotFoundException;
use App\Interfaces\Repositories\Visit\VisitRepositoryInterface;
use App\Interfaces\Services\Visit\VisitServiceInterface;
use App\Mappers\Visit\VisitNewDtoMapper;
use App\Mappers\Visit\VisitUpdateDtoMapper;
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

    public function update(Request $request, int $id): void
    {
        $visit = $this->visitRepo->getById($id);

        throw_if(
            empty($visit),
            new VisitNotFoundException(),
        );

        $dto = (new VisitUpdateDtoMapper())->createFromRequest($request);
        $this->visitRepo->update($dto, $id);
    }

    public function destroy(int $id): void
    {
        $visit = $this->visitRepo->getById($id);

        throw_if(
            empty($visit),
            new VisitNotFoundException(),
        );

        $this->visitRepo->destroy($id);
    }
}