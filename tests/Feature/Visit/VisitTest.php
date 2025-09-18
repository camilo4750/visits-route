<?php

namespace Tests\Feature\Visit;

use App\Entities\Visit\VisitEntity;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseTest;
use PHPUnit\Framework\Attributes\Test;

class VisitTest extends BaseTest
{
    use RefreshDatabase;

    #[Test]
    public function is_store_working(): void
    {
        $request = VisitEntity::factory()->make()->toArray();

        $response = $this->postJson(route('visits.store'), $request);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Tu visita han sido creada con éxito',
        ]);

        $this->assertDatabaseHas('visits', [
            'name' => $request['name'],
            'email' => $request['email'],
        ]);
    }

    #[Test]
    public function is_show_working(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $response = $this->getJson(route('visits.show', ['id' => $visit->id]));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Informacion de la visita',
            'data' => [
                'name' => $visit->name,
                'email' => $visit->email,
                'latitude' => $visit->latitude,
                'longitude' => $visit->longitude,
            ],
        ]);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'name',
                'email',
                'latitude',
                'longitude',
                'createdAt',
            ],
        ]);
    }

}