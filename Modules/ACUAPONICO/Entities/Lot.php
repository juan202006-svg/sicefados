<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'name', 'capacity', 'state'];
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\LotFactory::new();
    }
}
