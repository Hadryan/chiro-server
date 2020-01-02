<?php

namespace App\Repository;

use RuntimeException;
use App\Model\ShippingAddress;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShippingAddressRepository implements ShippingAddressRepositoryInterface
{

    const RULES = [
        'name' => 'required',
        'address' => 'required',
        'city_id' => 'required|numeric',
        'lat' => 'numeric',
        'lng' => 'numeric',
    ];

    /**
     * inserts a shipping address into the database
     * @param array|ShippingAddress $data
     * @param int $userId
     * @return ShippingAddress
     * @throws ValidationException
     * @throws RuntimeException
     */
    public function insert($data, int $userId): ShippingAddress
    {
        if ($data instanceof ShippingAddress) {
            $data->save();
            return $data;
        } else if (is_array($data)) {

            $validator = Validator::make($data, self::RULES);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data['user_id'] = $userId;

            return ShippingAddress::create($data);
        }

        throw new RuntimeException('Invalid data type');
    }

    /**
     * retrieves a shipping address from the database
     * @param int $id
     * @return ShippingAddress
     * @throws ModelNotFoundException
     */
    public function get(int $id): ShippingAddress
    {
        return ShippingAddress::findOrFail($id);
    }

    /**
     * retrieves the addresses for a user from the database
     * @param int $userId
     * @return Collection of @var ShippingAddress
     */
    public function getAddressesForUser(int $userId): Collection
    {
        return ShippingAddress::where('user_id', $userId)->get();
    }
}
