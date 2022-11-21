<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 18/11/2022
 * Time: 16:24
 */

namespace App\Http\Responses;


use Illuminate\Http\JsonResponse;

class FailResponse extends Response
{
    protected $title;
    protected $detail;
    protected $type;
    protected $instance;

    public function __construct($status, $content, $title, $detail, $type, $instance)
    {
        parent::__construct($status, $content);
        $this->title    = $title;
        $this->detail   = $detail;
        $this->type     = $type;
        $this->instance = $instance;
        $this->headers = [
            'Content-Type' => 'application/problem+json'
        ];
    }

    function getResponse(){
        return new JsonResponse($this->content, $this->status, $this->headers);
    }
}