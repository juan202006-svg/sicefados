<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\Resowing;

class ResowingTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'aquaponic_system_id',
        'resowing_id',
        'days_elapsed',
        'plant_count',
        'height_cm',
        'color_tone',
        'growth',
        'mortality',
        'notes'
    ];
    protected $table = 'resowing_trackings';

    public function aquaponicSystem()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }
    public function resowing()
    {
        return $this->belongsTo(Resowing::class, 'resowing_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\ResowingTrackingFactory::new();
    }
}
