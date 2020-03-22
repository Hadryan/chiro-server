<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use App\Model\Customer;
use App\Services\JWT\JWTServiceInterface;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoritesControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @var Customer*/
    private $currentCustomer;

    /** @var Product */
    private $product;

    private $jwt;

    protected function setUp(): void
    {
        parent::setUp();

        list($this->currentCustomer) = factory(Customer::class, 1)->create();
        $this->jwt = app(JWTServiceInterface::class)->generateJwtToken([
            'uid' => $this->currentCustomer->id,
        ]);

        list($this->product) = factory(Product::class, 1)->create();
    }

    public function test_add_favorite()
    {
        $response = $this->post('api/v1/favorites', [
            'product_id' => $this->product->id,
        ], [
            'Authorization' => 'Bearer ' . $this->jwt
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('favorites', [
            'product_id' => $this->product->id,
            'customer_id' => $this->currentCustomer->id,
        ]);
    }

    public function test_remove_favorite()
    {
        $response = $this->post('api/v1/favorites', [
            'product_id' => $this->product->id,
        ], [
            'Authorization' => 'Bearer ' . $this->jwt
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('favorites', [
            'product_id' => $this->product->id,
            'customer_id' => $this->currentCustomer->id,
        ]);

        $response = $this->delete('api/v1/favorites/' . $this->product->id, [], [
            'Authorization' => 'Bearer ' . $this->jwt
        ]);

        $response->assertOk();
        $this->assertDatabaseMissing('favorites', [
            'product_id' => $this->product->id,
            'customer_id' => $this->currentCustomer->id,
        ]);
    }
}
