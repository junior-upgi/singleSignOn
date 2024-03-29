<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $connection = 'UPGWeb';
    protected $table = "vStaffNode";

    protected $primaryKey = 'ID';
    public $keyType = 'string';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [];
    protected $hidden = [];

}
