<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Country as CountryModel;
use \Illuminate\Support\Facades\Validator;

class Country extends Controller
{

    public function __construct(CountryModel $countryModel)
    {
        $this->model = $countryModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(\App\Models\Country::all());
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
        //Data's request
        $data = $request->all();

        //Country validation
        $validated = Validator::make($data, $this->model->rulesInsert, $this->model->messagesValidated);

        //If the validation fail
        if($validated->fails()){
            return response()->json($validated->messages());
        }

        //New Country
        $country = $this->model->create($request->all());

        return $country;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
