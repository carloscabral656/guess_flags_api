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
        //Providing the mother's constructor with the specific model.
        parent::__construct($country);
    }
}