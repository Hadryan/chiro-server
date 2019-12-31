<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShippingAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respond(ShippingAddress::where([
            'user_id' => Auth::user()->id
        ])->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city_id' => 'required|numeric',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'address' => 'required'
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $address = ShippingAddress::create($data);

        return $this->response($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingAddress $shippingAddress)
    {
        return $this->respond($shippingAddress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingAddress $shippingAddress)
    {
        //
    }
}
