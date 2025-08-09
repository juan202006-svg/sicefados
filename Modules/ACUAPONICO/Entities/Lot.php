<?php

namespace Modules\ACUAPONICO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Resowing;


class Lot extends Model
{
    use HasFactory;

    protected $fillable = ['aquaponic_system_id', 'date', 'name', 'capacity', 'image', 'description', 'state'];
    protected $table = 'lots';

    // Relación con cultivos usando la tabla pivote crop_lot
    public function cultivos()
    {
        return $this->belongsToMany(Crop::class, 'crop_lot', 'lot_id', 'crop_id')
            ->withPivot('planted_quantity')
            ->withTimestamps();
    }

    // Total de unidades ocupadas en este lote (basado en la tabla pivote)
    public function getOcupadoAttribute()
    {
        return $this->cultivos->sum(function ($cultivo) {
            return $cultivo->pivot->planted_quantity ?? 0;
        });
    }

    // Disponible = capacidad - ocupado (no puede ser negativo)
    public function getDisponibleAttribute()
    {
        return max(0, $this->capacity - $this->ocupado);
    }

    // Actualiza automáticamente el estado del lote según ocupado
    public function actualizarEstadoAutomatico()
    {
        $ocupado = \DB::table('crop_lot')
            ->where('lot_id', $this->id)
            ->sum('planted_quantity');

        $disponible = max(0, $this->capacity - $ocupado);

        $this->state = ($disponible > 0) ? 'disponible' : 'ocupado';
        $this->save();
    }
    public function aquaponicSystem()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }
    public function resowings()
    {
        return $this->belongsToMany(Resowing::class, 'resowing_lot')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\LotFactory::new();
    }
}
