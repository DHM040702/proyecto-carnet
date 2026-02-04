<?php

namespace Tests\Feature\Feature;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EscuelasTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /**
     * Test that escuelas index can be accessed
     */
    public function test_escuelas_index(): void
    {
        $response = $this->get('/escuela');
        $response->assertStatus(200);
    }

    /**
     * Test that escuelas can be created
     */
    public function test_escuelas_can_be_created(): void
    {
        $facultad = Facultad::factory()->create();

        $response = $this->post('/escuela', [
            'escuela' => 'Ingeniería de Sistemas',
            'facultad_id' => $facultad->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('escuelas', [
            'escuela' => 'Ingeniería de Sistemas',
            'facultad_id' => $facultad->id,
        ]);
    }

    /**
     * Test that escuelas creation validates required fields
     */
    public function test_escuelas_creation_validates_required_fields(): void
    {
        $response = $this->post('/escuela', [
            'escuela' => '',
            'facultad_id' => '',
        ]);

        $response->assertSessionHasErrors(['escuela', 'facultad_id']);
    }

    /**
     * Test that escuelas can be updated
     */
    public function test_escuelas_can_be_updated(): void
    {
        $escuela = Escuela::factory()->create();
        $facultad = Facultad::factory()->create();

        $response = $this->put("/escuela/{$escuela->id}", [
            'escuela' => 'Ingeniería Informática',
            'facultad_id' => $facultad->id,
        ]);

        $response->assertRedirect();
        $escuela->refresh();
        $this->assertEquals('Ingeniería Informática', $escuela->escuela);
    }

    /**
     * Test that escuelas can be deleted
     */
    public function test_escuelas_can_be_deleted(): void
    {
        $escuela = Escuela::factory()->create();

        $response = $this->delete("/escuela/{$escuela->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('escuelas', [
            'id' => $escuela->id,
        ]);
    }
}
