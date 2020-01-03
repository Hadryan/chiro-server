<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlideControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @Test
     */
    public function testIndex()
    {
        $this->seed('SlideTableSeeder');

        $response = $this->get('api/v1/slides');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id',
                'title',
                'alt',
                'target_url',
                'image_path'
            ]
        ]);
    }
}
