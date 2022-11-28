<?php

namespace App\Http\Controllers;

use App\Http\Service\CountryServiceConcrete;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public $flag;
    public $alternatives;
    public $correctAnswer;

    public function __construct(CountryServiceConcrete $service)
    {
        $this->service = $service;
    }

    public function getQuestion(){
        try{
            $countries = $this->service->getAll();
            $quantity = $countries->count();
            $teste = rand(1, $quantity);
            return $teste;
        }catch(\Exception $e){

        }

    }
}
