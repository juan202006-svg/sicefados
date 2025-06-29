<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CropAquaponic extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'species_id', 'quantity', 'status'];
    protected $table = 'cropsaquaponics';
    
    public function species()
    {
        return $this->belongsTo(SpeciesAquaponic::class, 'species_id');
    }
    public function lotes()
    {
        return $this->belongsToMany(Lot::class, 'crop_lot');
    }



    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\CropAquaponicFactory::new();
    }
}
