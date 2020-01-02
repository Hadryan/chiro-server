<?php

namespace Tests\Feature;

use Tests\TestCase;

class SlideControllerTest extends TestCase
{
    /**
     * @Test
     */
    public function testIndex()
    {

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
