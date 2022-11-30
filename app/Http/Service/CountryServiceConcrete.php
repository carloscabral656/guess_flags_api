<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 18/11/2022
 * Time: 12:37
 */

namespace App\Http\Service;


use \App\Models\Country;

class CountryServiceConcrete extends ServiceFactory
{

    public function __construct(Country $country){
        //Providing the parent's constructor with the specific model.
        parent::__construct($country);
    }


    /**

     */
    public function getTotalCountrys(){ return $this->service->getAll()->count();}

    /**

     */
    public function getRandomCountry(){
        $randomCountry = rand(0, $this->getTotalCountrys()-1);
        return $this->get($randomCountry);
    }

}