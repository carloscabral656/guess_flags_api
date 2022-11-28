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

    public $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function getAll(){
        try{
            return $this->model->all();
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function get($id){
        try{
            return $this->model->find($id);
        }catch(\Exception $e){
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

    public function update($id, $data){
        try{
            $resource = $this->get($id);
            $deleted = $resource->update($data);
            return $deleted;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function delete($data){
        try{
            return $data->delete();
        }catch(\Exception $e){
            throw $e;
        }
    }
}
