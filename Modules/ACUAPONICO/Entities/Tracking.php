<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\Resowing;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['aquaponic_system_id', 'date', 'subject_type', 'subject_id', 'days_elapsed', 'notes'];
    protected $table = 'trackings';

    // Relación con el cultivo (para compatibilidad)
    public function crops()
    {
        return $this->belongsTo(Crop::class, 'subject_id')->where('subject_type', 'crop');
    }

    // Relación polimórfica para el sujeto (cultivo o resiembra)
    public function subject()
    {
        if ($this->subject_type === 'crop') {
            return $this->belongsTo(Crop::class, 'subject_id');
        } elseif ($this->subject_type === 'resowing') {
            return $this->belongsTo(Resowing::class, 'subject_id');
        }
    }

    // Método helper para obtener el cultivo (tanto si es directo como si es resiembra)
    public function getCropAttribute()
    {
        if ($this->subject_type === 'crop') {
            return $this->subject;
        } elseif ($this->subject_type === 'resowing') {
            return $this->subject->crops; // Resowing tiene relación con Crop
        }
        return null;
    }
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }


    public function latestFishTracking()
    {
        return $this->hasOne(\Modules\ACUAPONICO\Entities\TrackingFish::class)->latestOfMany();
    }

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\TrackingFactory::new();
    }
}
