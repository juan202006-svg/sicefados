<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityControl extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'activity_id', 'news', 'evidence'];
    protected $table = 'activity_Contrlos'; 
    
      public function activity()
    {
        return $this->belongsTo(ActivityAquaponic::class, 'activity_id');
    }
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\ActivityControlFactory::new();
    }
}
