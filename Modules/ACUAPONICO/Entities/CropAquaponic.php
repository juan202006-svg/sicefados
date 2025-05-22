<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CropAquaponic extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'species_id', 'lot_id', 'quantity', 'status'];
    protected $table = 'cropsaquaponics';
    public function species()
    {
        return $this->belongsTo(SpeciesAquaponic::class, 'species_id');
    }
    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id');
    }

    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\CropAquaponicFactory::new();
    }
}
