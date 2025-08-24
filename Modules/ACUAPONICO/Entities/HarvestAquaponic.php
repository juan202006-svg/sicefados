<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class HarvestAquaponic extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'date', 'crop_id', 'quantity', 'unit', 'mortality', 'destination', 'notes'];
    protected $table = 'harvestaquaponics';
    
    public function crops()
    {
        return $this->belongsTo(CropAquaponic::class, 'crop_id');
    }
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\HarvestAquaponicFactory::new();
    }
}
