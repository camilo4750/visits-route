<?php

namespace Tests\Integration\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\BaseTest;
use PHPUnit\Framework\Attributes\Test;
class VisitServiceTest extends BaseTest
{
    use RefreshDatabase;

    #[Test]
    public function is_store_service(): void
    {
        $data = [
            'name' => 'camilo Test',
            'email' => 'camilo.test@example.com',
            'latitude' => 10.123456,
            'longitude' => -74.123456,
        ];

        $request = new Request($data);
        $service = app(\App\Services\Visit\VisitService::class);
        $service->store($request);

        $this->assertDatabaseHas('visits', [
            'name' => 'camilo Test',
            'email' => 'camilo.test@example.com',
            'latitude' => 10.123456,
            'longitude' => -74.123456,
        ]);
    }

    #[Test]
    public function is_show_service(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $service = app(\App\Services\Visit\VisitService::class);

        $dto = $service->getById($visit->id);

        $this->assertNotNull($dto);
        $this->assertEquals($visit->name, $dto->name);
        $this->assertEquals($visit->email, $dto->email);
        $this->assertEquals($visit->latitude, $dto->latitude);
        $this->assertEquals($visit->longitude, $dto->longitude);
        $this->assertEquals($visit->created_at, $dto->createdAt);
    }
}
