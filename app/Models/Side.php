<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Side extends Model
{
    //
    protected $connection = 'upgi';
    protected $table = "Side";

    protected $primaryKey = 'ID';
    public $keyType = 'string';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [];
    protected $hidden = [];
}
