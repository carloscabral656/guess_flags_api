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

    //Message's for insert in Country
    public $messagesValidated = [
        'name.required' => 'Name is required'
    ];
}
