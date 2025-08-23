<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\ResowingTracking;
use Modules\ACUAPONICO\Entities\HarvestAquaponic;

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

    // Relación con resowing_trackings (si usas tabla separada)
    public function resowingTrackings()
    {
        return $this->hasMany(ResowingTracking::class, 'resowing_id');
    }

    // Accesor para la cantidad total resembrada
    public function getTotalQuantityAttribute()
    {
        return $this->lots()->sum('resowing_lot.quantity');
    }
    public function harvests()
    {
        return $this->morphMany(HarvestAquaponic::class, 'harvestable');
    }
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\ResowingFactory::new();
    }
}
