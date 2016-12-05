<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAuthority extends Model
{
    //
    protected $connection = 'upgi';
    protected $table = "roleAuthority";

    protected $primaryKey = 'ID';
    public $keyType = 'string';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = ['userID', 'roleID', 'type'];
    protected $hidden = [];
}
