<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 18/11/2022
 * Time: 16:24
 */

namespace App\Http\Responses;


use Illuminate\Http\JsonResponse;

class SuccessResponse extends Response
{

    public function __construct($content, $status)
    {
        parent::__construct($content, $status);
        $this->headers = [
            'Content-Type' => 'application/json'
        ];
    }

    public function getResponse(){
        return new JsonResponse($this->content, $this->status, $this->headers);
    }
}