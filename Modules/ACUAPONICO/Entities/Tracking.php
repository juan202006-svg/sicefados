<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'crop_id', 'days_elapsed', 'notes'];
    protected $table = 'trackings';

    public function crops()
    {
        return $this->belongsTo(CropAquaponic::class, 'crop_id');
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
