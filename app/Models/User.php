<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use App\Models\Staff;

class User extends Model implements AuthenticatableContract
{
    use SoftDeletes;
    use Authenticatable;
    
    protected $connection = 'upgi';
    protected $table = "user";
    protected $softDelete = true;

    protected $primaryKey = 'ID';
    public $incrementing = false;

    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [
        'ID', 
        'mobileSystemAccount', 
        'password', 
        'authorization',
        'erpID',
    ];
    protected $hidden = array('password', 'remember_token');

    public function staff()
    {
        return $this->hasOne(Staff::class, 'ID', 'erpID');
    }
}
