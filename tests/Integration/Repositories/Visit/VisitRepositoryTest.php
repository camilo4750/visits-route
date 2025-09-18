<?php

declare(strict_types=1);

namespace Tests\Integration\Repositories\Visit;

use App\Dto\Visit\VisitNewDto;
use App\Repositories\Visit\VisitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class VisitRepositoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
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

    #[Test]
    public function is_show_repository(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $repo = new \App\Repositories\Visit\VisitRepository();

        $dto = $repo->getById($visit->id);

        $this->assertNotNull($dto);
        $this->assertEquals($visit->name, $dto->name);
        $this->assertEquals($visit->email, $dto->email);
        $this->assertEquals($visit->latitude, $dto->latitude);
        $this->assertEquals($visit->longitude, $dto->longitude);
        $this->assertEquals($visit->created_at, $dto->createdAt);
    }

    #[Test]
    public function is_update_repository(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $dto = new \App\Dto\Visit\VisitUpdateDto();
        $dto->name = 'Nombre Actualizado';
        $dto->email = 'actualizado@example.com';
        $dto->latitude = 33.333333;
        $dto->longitude = -66.666666;

        $repo = new \App\Repositories\Visit\VisitRepository();
        $repo->update($dto, $visit->id);

        $this->assertDatabaseHas('visits', [
            'id' => $visit->id,
            'name' => $dto->name,
            'email' => $dto->email,
            'latitude' => $dto->latitude,
            'longitude' => $dto->longitude,
        ]);
    }

    #[Test]
    public function is_destroy_repository(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $repo = new \App\Repositories\Visit\VisitRepository();
        $repo->destroy($visit->id);

        $this->assertDatabaseMissing('visits', [
            'id' => $visit->id,
        ]);
    }
}
