<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Delivery_company;

class Delivery_companiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_companies = Delivery_company::paginate(5);
        
        return view('manager.delivery_company_index', ['delivery_companies' => $delivery_companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('manager.delivery_company_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delivery_company = new Delivery_company;

        $delivery_company->name = $request->name;
        $delivery_company->telephone = $request->telephone;
        $delivery_company->shipping_cost = $request->shipping_cost;

        $delivery_company->save();

        return redirect('manager/delivery_companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery_company = Delivery_company::find($id);

        return view('manager.delivery_company_show', ['delivery_company' => $delivery_company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery_company = Delivery_company::find($id);

        return view('manager.delivery_company_edit', ['delivery_company' => $delivery_company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $delivery_company = Delivery_company::find($id);

        $delivery_company->name = $request->name;
        $delivery_company->telephone = $request->telephone;
        $delivery_company->shipping_cost = $request->shipping_cost;

        return redirect('/manager/delivery_companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery_company = Delivery_company::find($id);

        $delivery_company->delete();

        return redirect('manager/delivery_companies');
    }
}
