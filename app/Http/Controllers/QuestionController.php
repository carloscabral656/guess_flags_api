<?php

namespace App\Http\Controllers;

use App\Http\Responses\SuccessResponse;
use App\Http\Service\CountryServiceConcrete;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public $flag;
    public $alternatives;
    public $correctAnswer;
    public $alternativesQuantity;

    public function __construct(CountryServiceConcrete $service){
        $this->service = $service;
        $this->alternativesQuantity = 4;
    }

    public function getQuestion(){

        //Country
        return $this->getAlternatives();

        //Other options


    }

    public function getCorrectAnswer(){
        try{
            //Get all Countries
            $countries = $this->service->getAll();

            //Array with the id of all possible countries
            $possibleCountries = $countries->map(function($country){
                return $country->id_country;
            });

            //Find a random country to pick as a right answer
            $randomCountry = rand(0, $possibleCountries->count()-1);

            //Return the correct country
            return $countries->get($randomCountry);
        }catch(\Exception $e){
            return (
                new SuccessResponse('', 200)
            )->getResponse();
        }
    }

    /**

     */
    public function getAlternatives(){
        $countrys = [];
        $i = 0;
        while($this->areAltenativesValids($countrys) && $i < $this->alternativesQuantity){
            $countrys[] = $this->service->getRandomCountry();
            $i++;
        }
        if($this->areAltenativesValids($countrys)) return $countrys;
    }

    /**
        Verify if the country is repeated.
     */
    public function areAltenativesValids($alternatives){
        $i = 0;
        $j = 0;

        if(in_array(count($alternatives), [0, 1])) return true;

        for($i = 0 ; $i < count($alternatives); $i++){
            for($j = $i ; $j < count($alternatives); $j++){
                if($alternatives[$i]->id_country === $alternatives[$j]->id_country){
                    return false;
                }
            }
        }
        return true;
    }
}
