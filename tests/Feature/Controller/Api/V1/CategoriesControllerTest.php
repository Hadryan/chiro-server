<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoriesList()
    {
        $this->createSampleCategory();

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
