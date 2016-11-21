<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $connection = 'UPGWeb';
    protected $table = "vStaff";

    protected $primaryKey = 'ID';
    
    protected $fillable = [];
    protected $hidden = [];

}
