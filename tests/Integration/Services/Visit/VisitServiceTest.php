<?php

namespace Tests\Integration\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\BaseTest;

class VisitServiceTest extends BaseTest
{
    use RefreshDatabase;

    /**
     *  @test 
     */
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
}
