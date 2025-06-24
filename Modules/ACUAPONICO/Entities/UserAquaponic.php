<?php
namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ACUAPONICO\Entities\ProductiveUnit;


class UserAquaponic extends Model
{
    protected $table = 'user_aquaponics';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'productive_unit_id',
        'status',
    ];

    public function productiveUnit()
{
    return $this->belongsTo(ProductiveUnit::class, 'productive_unit_id');
}

}

