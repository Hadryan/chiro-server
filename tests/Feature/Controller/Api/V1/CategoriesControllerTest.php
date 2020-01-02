<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    public function testCategoriesList()
    {
        $response = $this->get('api/v1/categories');
        $response->assertOk();
        $response->assertJsonStructure([
            [
                'name',
                'parent_id',
                'description',
                'image_path',
                'type'
            ]
        ]);
    }
}
