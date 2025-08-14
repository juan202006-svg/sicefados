<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\Resowing;
use Modules\ACUAPONICO\Entities\TrackingFish;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'aquaponic_system_id',
        'date',
        'subject_type',
        'subject_id',
        'days_elapsed',
        'notes'
    ];

    protected $table = 'trackings';

    /**
     * Relación polimórfica: puede ser un Crop o un Resowing.
     */
    public function subject()
    {
        return $this->morphTo();
    }

    public function getCropAttribute()
    {
        if ($this->subject instanceof Crop) {
            return $this->subject;
        } elseif ($this->subject instanceof Resowing) {
            return $this->subject->crop; 
        }
        return null;
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function latestFishTracking()
    {
        return $this->hasOne(TrackingFish::class)->latestOfMany();
    }

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\TrackingFactory::new();
    }
}
