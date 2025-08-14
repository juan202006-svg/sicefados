<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use Modules\AGROCEFA\Entities\Variety;
use Modules\SICA\Entities\Labor;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AGROCEFA\Entities\Specie;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\Tracking;


class Crop extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = [
        'date',
        'name',
        'sown_area',
        'seed_time',
        'density',
        'variety_id',
        'finish_date',
        'species_id',
        'quantity',
        'status',
        'aquaponic_system_id'

    ];
    protected $table = 'crops';

    public function species()
    {
        return $this->belongsTo(Specie::class, 'species_id');
    }
    public function lotes()
    {
        return $this->belongsToMany(Lot::class, 'crop_lot', 'crop_id', 'lot_id')
            ->withPivot('planted_quantity')
            ->withTimestamps();;
    }
    public function aquaponicSystem()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }

    public function trackings()
    {
        return $this->morphMany(Tracking::class, 'subject');
    }

    public function variety()
    {
        return $this->belongsTo(Variety::class);
    }

    public function environments()
    {
        return $this->belongsToMany(Environment::class, 'crop_environments'); // Asegúrate de que coincida con el nombre de tu tabla
    }


    public function labors()
    {
        return $this->belongsToMany(Labor::class, 'crop_labors');
    }
}
