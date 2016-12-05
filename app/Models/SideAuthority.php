<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SideAuthority extends Model
{
    //
    protected $connection = 'upgi';
    protected $table = "SideAuthority";

    protected $primaryKey = 'ID';
    public $keyType = 'string';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = ['userID', 'sideID', 'type'];
    protected $hidden = [];
}
