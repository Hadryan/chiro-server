<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function testListProducts()
    {
        $response = $this->get('/api/v1/products');

        $response->assertOk();
        $response->assertJson([
            []
        ]);
    }
}
