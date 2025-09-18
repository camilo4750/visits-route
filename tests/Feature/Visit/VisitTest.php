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

    #[Test]
    public function is_update_working(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $updateData = [
            'name' => 'Nuevo Nombre',
            'email' => 'nuevo.email@example.com',
            'latitude' => 20.123456,
            'longitude' => -70.654321,
        ];

        $response = $this->putJson(route('visits.update', ['id' => $visit->id]), $updateData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Tu visita ha sido actualizada con éxito',
        ]);

        $this->assertDatabaseHas('visits', [
            'id' => $visit->id,
            'name' => $updateData['name'],
            'email' => $updateData['email'],
            'latitude' => $updateData['latitude'],
            'longitude' => $updateData['longitude'],
        ]);
    }

    #[Test]
    public function is_destroy_working(): void
    {
        $visit = \App\Entities\Visit\VisitEntity::factory()->create();

        $response = $this->deleteJson(route('visits.destroy', ['id' => $visit->id]));

        $response->assertStatus(200);

        $this->assertDatabaseMissing('visits', [
            'id' => $visit->id,
        ]);
    }
}