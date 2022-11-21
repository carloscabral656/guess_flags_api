<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 18/11/2022
 * Time: 12:38
 */

namespace App\Http\Service;


use Illuminate\Database\Eloquent\Model;

class ServiceFactory
{

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function getAll(){
        try{
            return $this->model->all();
        }catch(\SQLiteException $e){
            throw $e;
        }
    }

    public function get($id){
        try{
            return $this->model->find($id);
        }catch(\SQLiteException $e){
            throw $e;
        }
    }

    public function create($data){
        try{
            return $this->model->create($data);
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function update($data){

    }

    public function delete($data){
        try{
            return $data->delete();
        }catch(\SQLiteException $e){
            throw $e;
        }
    }
}
