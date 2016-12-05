<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Side;

class Role extends Model
{
    //
    protected $connection = 'upgi';
    protected $table = "role";

    protected $primaryKey = 'ID';
    public $keyType = 'string';

    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [];
    protected $hidden = [];

    public function side()
    {
        return $this->hasOne(Side::class, 'ID', 'sideID');
    }
}
