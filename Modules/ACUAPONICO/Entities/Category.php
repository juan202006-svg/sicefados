<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'name'];
    protected $table = 'categories';
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\CategoryFactory::new();
    }
}