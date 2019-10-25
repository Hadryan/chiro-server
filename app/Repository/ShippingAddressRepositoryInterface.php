<?php

namespace App\Repository;

use RuntimeException;
use App\Model\ShippingAddress;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ShippingAddressRepositoryInterface
{
    /**
     * inserts a shipping address into the database
     * @param array|ShippingAddress $data
     * @param int $userId
     * @return ShippingAddress
     * @throws ValidationException
     * @throws RuntimeException
     */
    public function insert($data, int $userId): ShippingAddress;

    /**
     * retrieves a shipping address from the database
     * @param int $id
     * @return ShippingAddress
     * @throws ModelNotFoundException
     */
    public function get(int $id): ShippingAddress;

    /**
     * retrieves the addresses for a user from the database
     * @param int $userId
     * @return Collection of @var ShippingAddress
     */
    public function getAddressesForUser($userId): Collection;
}
