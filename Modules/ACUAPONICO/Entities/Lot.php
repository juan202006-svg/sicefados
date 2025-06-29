<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'name', 'capacity', 'state'];
    protected $table = 'lots';
    
    public function cultivos()
{
    return $this->belongsToMany(CropAquaponic::class, 'crop_lot');
}

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\LotFactory::new();
    }
}
