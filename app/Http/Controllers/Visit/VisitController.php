<?php

namespace App\Http\Controllers\visit;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Visit\VisitControllerValidate;
use App\Http\Controllers\Wrappers\ControllerWrapper;
use App\Interfaces\Services\Visit\VisitServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    private $visitService;

    public function __construct(VisitServiceInterface $visitService)
    {
        $this->visitService = $visitService;
    }

    public function store(Request $request): array|JsonResponse
    {
        return ControllerWrapper::execWithJsonSuccessResponse(function () use ($request) {
            (new VisitControllerValidate())
                ->validateStoreRequest($request);

            $this->visitService->store($request);

            return [
                "message" => "Tu visita han sido creada con éxito",
            ];
        });
    }

    public function show(int $id): array|JsonResponse
    {
        return ControllerWrapper::execWithJsonSuccessResponse(function () use ($id) {
            $visit = $this->visitService->getById($id);

            return [
                "message" => "Informacion de la visita",
                "data" => $visit,
            ];
        });
    }

    public function update(Request $request, int $id): array|JsonResponse
    {
        return ControllerWrapper::execWithJsonSuccessResponse(function () use ($request, $id) {
            (new VisitControllerValidate())
                ->validateUpdateRequest($request);

            $this->visitService->update($request, $id);

            return [
                "message" => "Tu visita ha sido actualizada con éxito",
            ];
        });
    }

}