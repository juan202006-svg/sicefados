<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityAquaponic extends Model
{
    use HasFactory;

    protected $table = 'activities_aquaponics';

    protected $fillable = ['activity_name','date', 'start_date', 'end_date', 'user_id', 'description', 'activity_status', 'enviada'
    ];

     public function activity()
    {
        return $this->belongsTo(UserAquaponic::class, 'activity_id');
    }
    
    public function user()
    {
        return $this->belongsTo(UserAquaponic::class, 'user_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\ActivityAquaponicFactory::new();
    }
}
