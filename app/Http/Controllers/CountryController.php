<?php

namespace App\Http\Controllers;

use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Service\CountryServiceConcrete;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{

    private $service;

    /**
     * Creates an instance of the class, the construct must have a service.
     * @param \App\Http\Service\ServiceFactory
     */
    public function __construct(CountryServiceConcrete $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Response
     */
    public function index()
    {
        return (
            new SuccessResponse($this->service->getAll(), 200)
        )->getResponse();
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
        $validated = Validator::make($data, $this->service->model->rulesInsert, $this->service->model->messagesValidatedInsert);

        //If the validation fail
        if($validated->fails()){
            return (
                new FailResponse(
                    200,
                    $validated->messages(),
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();
        }

        try {
            $country = $this->service->create($request->all());
            return $country;
        }catch(\Exception $e){
            return (
                new FailResponse(
                    "SQL Problem.",
                    200,
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();
        }
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
            return (
                new SuccessResponse($country, 200)
            )->getResponse();
        }catch(\Exception $e){
            return (
                new FailResponse(
                    200,
                    $e->getMessage(),
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();
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
        //Data's request
        $data = $request->all();

        //Country validation
        $validated = Validator::make($data, $this->service->model->rulesUpdate, $this->service->model->messagesValidatedUpdate);

        //If the validation fail
        if($validated->fails()){
            return (
                new FailResponse(
                    200,
                    $validated->messages(),
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();
        }

        try {
            //Update the specific country
            return $this->service->update($id, $data);
        }catch(\Exception $e){
            return (
                new FailResponse(
                    200,
                    $e->getMessage(),
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();
        }
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
                        200,
                        "Country doesn't exist.",
                        "Country doesn't exist.",
                        "",
                        "",
                        ""
                    )
                )->getResponse();
            }
            $deleted = $this->service->delete($country);
            if ($deleted) {
                return (
                    new SuccessResponse("Country deleted.", 200)
                )->getResponse();
            }
            return (
                new FailResponse(
                    200,
                    "",
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();
        }catch (\Exception $e){
            return (
                new FailResponse(
                    200,
                    $e->getMessage(),
                    "SQL Problem.",
                    "",
                    "",
                    ""
                )
            )->getResponse();;
        }
    }
}
