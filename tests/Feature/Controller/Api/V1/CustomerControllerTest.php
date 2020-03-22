<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Customer;
use App\Services\JWT\JWTServiceInterface;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @var Customer*/
    private $currentCustomer;

    private $jwt;

    protected function setUp(): void
    {
        parent::setUp();

        list($this->currentCustomer) = factory(Customer::class, 1)->create();
        $this->jwt = app(JWTServiceInterface::class)->generateJwtToken([
            'uid' => $this->currentCustomer->id,
        ]);
    }
    /**
     * @Test
     */
    public function test_get_customer_data()
    {
        $response = $this->get('api/v1/customers', [
            'Authorization' => 'Bearer ' . $this->jwt,
            'Accept' => 'application/json'
        ]);

        $response->assertOk();
        $response->assertJson([
            'name' => $this->currentCustomer->name
        ]);
    }

    public function test_update_customer_data_missing_name()
    {
        $response = $this->patch(
            'api/v1/customers',
            [
                // 'name' => 'NewName',
            ],
            [
                'Authorization' => 'Bearer ' . $this->jwt,
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(422);
    }
    public function test_update_customer_data()
    {
        $response = $this->patch(
            'api/v1/customers',
            [
                'name' => 'NewName',
            ],
            [
                'Authorization' => 'Bearer ' . $this->jwt,
                'Accept' => 'application/json'
            ]
        );

        $response->assertOk();
        $response->assertJson([
            'name' => 'NewName'
        ]);
    }
}
