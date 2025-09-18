<?php

declare(strict_types=1);

namespace Tests\Integration\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Repositories\Visit\VisitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisitRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function is_store_repository(): void
    {
        $dto = new \App\Dto\Visit\VisitNewDto();
        $dto->name = 'camilo Test';
        $dto->email = 'camilo.test@example.com';
        $dto->latitude = 11.1111111;
        $dto->longitude = -77.7777777;

        $repo = new \App\Repositories\Visit\VisitRepository();
        $repo->store($dto);

        $this->assertDatabaseHas('visits', [
            'name' => 'camilo Test',
            'email' => 'camilo.test@example.com',
            'latitude' => 11.1111111,
            'longitude' => -77.7777777,
        ]);
    }
}
