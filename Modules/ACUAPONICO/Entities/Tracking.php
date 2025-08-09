<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Lot;

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


    public function latestFishTracking()
    {
        return $this->hasOne(\Modules\ACUAPONICO\Entities\TrackingFish::class)->latestOfMany();
    }

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\TrackingFactory::new();
    }
}
