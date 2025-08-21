<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\TrackingPlant;
use Modules\ACUAPONICO\Entities\TrackingFish;


class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['aquaponic_system_id', 'date', 'crop_id', 'days_elapsed', 'notes'];
    protected $table = 'trackings';

    public function crops()
    {
        return $this->belongsTo(Crop::class, 'crop_id');
    }
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function aquaponicSystem()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }


    public function trackingPlants()
    {
        return $this->hasMany(TrackingPlant::class, 'tracking_id');
    }
     public function latestFishTracking()
    {
        return $this->hasOne(TrackingFish::class, 'tracking_id')->latestOfMany();
    }

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\TrackingFactory::new();
    }
}