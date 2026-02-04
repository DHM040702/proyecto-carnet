<?php

namespace Tests\Feature;

use App\Models\Facultad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FacultadesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /**
     * Test that facultades index can be accessed
     */
    public function test_facultades_index(): void
    {
        $response = $this->get('/facultad');
        $response->assertStatus(200);
    }

    /**
     * Test that facultades can be created
     */
    public function test_facultades_can_be_created(): void
    {
        $response = $this->post('/facultad', [
            'facultad' => 'Ingeniería',
            'abreviatura' => 'ING',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('facultades', [
            'facultad' => 'Ingeniería',
            'abreviatura' => 'ING',
        ]);
    }

    /**
     * Test that facultades creation validates required fields
     */
    public function test_facultades_creation_validates_required_fields(): void
    {
        $response = $this->post('/facultad', [
            'facultad' => '',
            'abreviatura' => '',
        ]);

        $response->assertSessionHasErrors(['facultad']);
    }

    /**
     * Test that facultades can be updated
     */
    public function test_facultades_can_be_updated(): void
    {
        $facultad = Facultad::factory()->create();

        $response = $this->put("/facultad/{$facultad->id}", [
            'facultad' => 'Ingeniería Actualizada',
            'abreviatura' => 'UPDT',
        ]);

        $response->assertRedirect();
        $facultad->refresh();
        $this->assertEquals('Ingeniería Actualizada', $facultad->facultad);
    }

    /**
     * Test that facultades can be deleted
     */
    public function test_facultades_can_be_deleted(): void
    {
        $facultad = Facultad::factory()->create();

        $response = $this->delete("/facultad/{$facultad->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('facultades', [
            'id' => $facultad->id,
        ]);
    }
}
