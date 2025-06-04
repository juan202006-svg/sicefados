<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackingFish extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_id', 'fish_count', 'weight_gr', 'biomass_gr', 'weight_gain_gr', 'mortality'];
    protected $table = 'trackingfish';
    public function Tracking()
    {
        return $this->belongsTo(Tracking::class, 'tracking_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\TrackingFishFactory::new();
    }
}
