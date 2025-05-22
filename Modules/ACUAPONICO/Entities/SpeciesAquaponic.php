<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class speciesAquaponic extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'category_id', 'scientific_name', 'common_name', 'life_cycle', 'optimal_temperature'];
    protected $table = 'speciesaquaponics';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\SpeciesAquaponicFactory::new();
    }
}
