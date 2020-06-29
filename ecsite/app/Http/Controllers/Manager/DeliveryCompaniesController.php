<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryCompany;
use App\Http\Requests\DeliveryCompaniesRequest;

class DeliveryCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverycompanies = DeliveryCompany::paginate(5);

        return view('manager/delivery_company/delivery_company_index', ['deliverycompanies' => $deliverycompanies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager/delivery_company/delivery_company_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryCompaniesRequest $request)
    {
        DeliveryCompany::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'shipping_cost' => $request->shipping_cost,
        ]);

        return redirect('manager/delivery_companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCompany $delivery_company)
    {

        return view('manager/delivery_company/delivery_company_show', ['delivery_company' => $delivery_company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryCompany $delivery_company)
    {


        return view('manager/delivery_company/delivery_company_edit', ['deliverycompany' => $delivery_company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryCompaniesRequest $request, DeliveryCompany $delivery_company)
    {


        $delivery_company->name = $request->name;
        $delivery_company->telephone = $request->telephone;
        $delivery_company->shipping_cost = $request->shipping_cost;

        $delivery_company->save();

        return redirect('/manager/delivery_companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryCompany $delivery_company)
    {

        $delivery_company->delete();

        return redirect('manager/delivery_companies');
    }
}
