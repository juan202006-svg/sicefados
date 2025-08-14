<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\AquaponicSystem;

class Resowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'aquaponic_system_id',
        'crop_id',
        'original_mortality',
        'description',
        'status',
        'date'
    ];
    protected $table = 'resowings';

    public function lots()
    {
        return $this->belongsToMany(Lot::class, 'resowing_lot')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function crops()
    {
        return $this->belongsTo(Crop::class, 'crop_id');
    }
    public function system()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }

    // Método auxiliar para obtener los trackings del cultivo asociado
    public function getTrackingsAttribute()
    {
        return $this->crops ? $this->crops->trackings : collect();
    }
    public function trackings()
    {
        return $this->morphMany(Tracking::class, 'subject');
    }
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\ResowingFactory::new();
    }
}
