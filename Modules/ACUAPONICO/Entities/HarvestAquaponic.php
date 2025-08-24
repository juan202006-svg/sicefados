<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ACUAPONICO\Entities\AquaponicSystem;


class HarvestAquaponic extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'aquaponic_system_id',
        'quantity',
        'unit',
        'mortality',
        'destination',
        'notes',
        'harvestable_id',
        'harvestable_type',
    ];
    protected $table = 'harvestsaquaponics';

    public function aquaponicSystem()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }

    public function harvestable()
    {
        return $this->morphTo();
    }
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\HarvestAquaponicFactory::new();
    }
}
