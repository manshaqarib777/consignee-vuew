<?php

namespace App\Http\Controllers\App\Address;

use App\Models\App\Address\Address;
use App\Models\App\Country\Country;
use App\Http\Controllers\Controller;
use App\Filters\App\Address\AddressFilter;
use App\Services\App\Address\AddressService;
use App\Http\Requests\App\AddressRequest as Request;
use App\Models\App\Consignee\Consignee;
use App\Notifications\App\Address\AddressNotification;

class AddressController extends Controller
{
    /**
     * AddressController constructor.
     * @param AddressService $service
     * @param AddressFilter $filter
     */
    public function __construct(AddressService $service, AddressFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->service
            ->filters($this->filter)
            ->with('country')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view('address.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = $this->service->save();

        notify()
            ->on('row_created')
            ->with($address)
            ->send(AddressNotification::class);

        return created_responses('data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $address = $this->service->update($address);

        notify()
            ->on('row_updated')
            ->with($address)
            ->send(AddressNotification::class);

        return updated_responses('data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Address $address)
    {
        if ($this->service->delete($address)) {

            notify()
                ->on('row_deleted')
                ->with((object)$address->toArray())
                ->send(AddressNotification::class);

            return deleted_responses('data');
        }
        return failed_responses();
    }
    public function getNameFromDatatable()
    {
        return $this->service->getName();
    }
    public function getCountries()
    {
        return Country::select('name','id')->get();
    }
    public function getConsignees()
    {
        return Consignee::select('name','id')->get();
    }
}
