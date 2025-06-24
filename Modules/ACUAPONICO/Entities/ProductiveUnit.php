<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductiveUnit extends Model
{
    protected $table = 'productive_units'; // Usa el nombre real de tu tabla

    protected $fillable = ['name'];
}
