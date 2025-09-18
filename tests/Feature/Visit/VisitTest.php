<?php

namespace Tests\Feature\Visit;

use App\Entities\Visit\VisitEntity;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseTest;

class VisitTest extends BaseTest
{
    use RefreshDatabase;

    /**
     *  @test 
     */

    public function is_store_working(): void
    {
        $request = VisitEntity::factory()->make()->toArray();

        $response = $this->postJson(route('visits.store'), $request);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Tu visita han sido creada con éxito',
        ]);

        $this->assertDatabaseHas('visits', [
            'name'  => $request['name'],
            'email' => $request['email'],
        ]);
    }
}