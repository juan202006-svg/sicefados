<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use Modules\ACUAPONICO\Entities\Lot;

class AquaponicSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
        'lot_capacity',
        'active'
    ];
    protected $table = 'aquaponic_systems';

    public function environment()
    {
        return $this->belongsTo(Environment::class, 'environment_id');
    }
    public function lots()
{
    return $this->hasMany(Lot::class, 'aquaponic_system_id');
}

    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\AquaponicSystemFactory::new();
    }
}
