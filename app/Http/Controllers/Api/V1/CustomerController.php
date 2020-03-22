<?php

namespace App\Http\Controllers\Api\V1;

use App\Model\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class CustomerController extends Controller
{

    public function index()
    {
        $customer = Customer::findOrFail(auth('api')->id());
        return $this->respond($customer);
    }

    public function update(Request $request)
    {
        $input = $this->validate($request, [
            'name' => 'required'
        ]);

        $customer = Customer::findOrFail(auth('api')->id());
        $customer->name = $input['name'];
        $customer->save();

        return $this->respond($customer);
    }
}
