<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'id_country';

    protected $fillable = [
        'name'
    ];

    //Rules for insert in Country
    public $rulesInsert = [
        'name' => 'required'
    ];

    //Rules for insert in Country
    public $rulesUpdate = [
        'name' => 'required'
    ];

    //Message's for insert in Country
    public $messagesValidatedInsert = [
        'name.required' => 'Name is required'
    ];

    //Message's for insert in Country
    public $messagesValidatedUpdate = [
        'name.required' => 'Name is required'
    ];
}
