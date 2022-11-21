<?php

namespace App\Http\Controllers;

use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Service\CountryServiceConcrete;
use Illuminate\Http\Request;
use \App\Models\Country as CountryModel;
use \Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{

    public function __construct(CountryServiceConcrete $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->service->getAll());
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
        $validated = Validator::make($data, $this->service->model->rulesInsert, $this->service->model->messagesValidated);

        //If the validation fail
        if($validated->fails()){
            return response()->json($validated->messages());
        }

        //New Country
        $country = $this->service->create($request->all());

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
        try{
            $country = $this->service->get($id);
            return response()->json($country);
        }catch(\SQLiteException $e){
            return response()->json($e);
        }
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
        $country = $this->model->find($id);
        return $country;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $country = $this->service->get($id);
            if(is_null($country)) {
                return (
                    new FailResponse(
                        "Country doesn't exist.",
                        200,
                        "Country doesn't exist.",
                        "",
                        "",
                        "")
                )->getResponse();
            }

            $deleted = $this->service->delete($country);
            if ($deleted) {
                return (
                    new SuccessResponse("Country deleted.", 200)
                )->getResponse();
            }

            return (
                new SuccessResponse("Country doesn't exist.", 200)
            )->getResponse();
        }catch (\Exception $e){
            return (new FailResponse($e->getMessage(), 200))->getResponse();
        }
    }
}
