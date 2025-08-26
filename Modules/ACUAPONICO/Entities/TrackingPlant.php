<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackingPlant extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_id','plant_count','height_cm','color_tone','growth','mortality'];
    protected $table = 'trackingplant';

    public function Tracking()
    {
        return $this->belongsTo(Tracking::class, 'tracking_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\TrackingPlantFactory::new();
    }
}
