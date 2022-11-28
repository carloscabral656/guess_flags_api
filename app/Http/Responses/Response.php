<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 18/11/2022
 * Time: 16:23
 */

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Response as FacadeResponse;

abstract class Response
{
    //Attributes
    protected $headers;
    protected $status;
    protected $content;
    protected $response;


    //Construct parent's class
    public function __construct($content, $status){
        $this->content  = $content;
        $this->status   = $status;
        $this->response = new JsonResponse();
    }

    abstract function getResponse();
}