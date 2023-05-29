<?php

namespace App\Http\Controllers\App\Consignee;

use App\Filters\App\Consignee\ConsigneeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\ConsigneeRequest as Request;
use App\Models\App\Consignee\Consignee;
use App\Notifications\App\Consignee\ConsigneeNotification;
use App\Services\App\Consignee\ConsigneeService;

class ConsigneeController extends Controller
{
    /**
     * ConsigneeController constructor.
     * @param ConsigneeService $service
     * @param ConsigneeFilter $filter
     */
    public function __construct(ConsigneeService $service, ConsigneeFilter $filter)
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
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view('consignee.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consignee = $this->service->save();

        notify()
            ->on('row_created')
            ->with($consignee)
            ->send(ConsigneeNotification::class);

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
    public function update(Request $request, Consignee $consignee)
    {
        $consignee = $this->service->update($consignee);

        notify()
            ->on('row_updated')
            ->with($consignee)
            ->send(ConsigneeNotification::class);

        return updated_responses('data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Consignee $consignee)
    {
        if ($this->service->delete($consignee)) {

            notify()
                ->on('row_deleted')
                ->with((object)$consignee->toArray())
                ->send(ConsigneeNotification::class);

            return deleted_responses('data');
        }
        return failed_responses();
    }
    public function getNameFromDatatable()
    {
        return $this->service->getName();
    }
}
