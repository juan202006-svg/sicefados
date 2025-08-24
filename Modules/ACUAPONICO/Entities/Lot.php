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
        
         return $this->belongsToMany(Cultivo::class, 'cultivo_lot')->withPivot('planted_quantity');
    }
    

    // Relación con resiembras usando la tabla pivote resowing_lot
    public function resowings()
    {
        return $this->belongsToMany(Resowing::class, 'resowing_lot')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Total de unidades ocupadas en este lote (suma de cultivos + resiembras - mortalidades de cultivos y resiembras)
    public function getOcupadoAttribute()
    {
        $ocupadoCultivos = $this->cultivos->sum(function ($cultivo) {
            return $cultivo->pivot->planted_quantity ?? 0;
        });

        $ocupadoResiembras = $this->resowings->sum(function ($resiembra) {
            return $resiembra->pivot->quantity ?? 0;
        });

        // Suma de mortalidades de plantas asociadas a este lote (de cultivos)
        $mortalidadPlantas = \DB::table('trackingplant')
            ->join('trackings', 'trackingplant.tracking_id', '=', 'trackings.id')
            ->join('crop_lot', 'trackings.crop_id', '=', 'crop_lot.crop_id')
            ->where('crop_lot.lot_id', $this->id)
            ->groupBy('crop_lot.lot_id') // Evitar duplicados
            ->sum('trackingplant.mortality');

        // Suma de mortalidades de peces asociadas a este lote (de cultivos)
        $mortalidadPeces = \DB::table('trackingfish')
            ->join('trackings', 'trackingfish.tracking_id', '=', 'trackings.id')
            ->join('crop_lot', 'trackings.crop_id', '=', 'crop_lot.crop_id')
            ->where('crop_lot.lot_id', $this->id)
            ->groupBy('crop_lot.lot_id') // Evitar duplicados
            ->sum('trackingfish.mortality');

        // Suma de mortalidades de resiembras asociadas a este lote (de resowing_trackings)
        $mortalidadResiembras = \DB::table('resowing_trackings')
            ->join('resowings', 'resowing_trackings.resowing_id', '=', 'resowings.id')
            ->join('resowing_lot', 'resowings.id', '=', 'resowing_lot.resowing_id')
            ->where('resowing_lot.lot_id', $this->id)
            ->groupBy('resowing_lot.lot_id') // Evitar duplicados
            ->sum('resowing_trackings.mortality');

        $ocupado = $ocupadoCultivos + $ocupadoResiembras - ($mortalidadPlantas + $mortalidadPeces + $mortalidadResiembras);
        return max(0, $ocupado); // Asegurar que no sea negativo
    }

    // Disponible = capacidad - ocupado (no puede ser negativo)
    public function getDisponibleAttribute()
    {
        return max(0, $this->capacity - $this->ocupado);
    }

    // Actualiza automáticamente el estado del lote según ocupado
public function actualizarEstadoAutomatico($forzar = false)
{
    if (!$forzar) {
        $disponible = $this->disponible;
        $this->state = ($disponible > 0) ? 'disponible' : 'no disponible';
        $this->save();
    }
}

    // Método de depuración para verificar los valores
    public function debugOccupation()
    {
        $ocupadoCultivos = $this->cultivos->sum(function ($cultivo) {
            return $cultivo->pivot->planted_quantity ?? 0;
        });
        $ocupadoResiembras = $this->resowings->sum(function ($resiembra) {
            return $resiembra->pivot->quantity ?? 0;
        });
        $mortalidadPlantas = \DB::table('trackingplant')
            ->join('trackings', 'trackingplant.tracking_id', '=', 'trackings.id')
            ->join('crop_lot', 'trackings.crop_id', '=', 'crop_lot.crop_id')
            ->where('crop_lot.lot_id', $this->id)
            ->sum('trackingplant.mortality');
        $mortalidadPeces = \DB::table('trackingfish')
            ->join('trackings', 'trackingfish.tracking_id', '=', 'trackings.id')
            ->join('crop_lot', 'trackings.crop_id', '=', 'crop_lot.crop_id')
            ->where('crop_lot.lot_id', $this->id)
            ->sum('trackingfish.mortality');
        $mortalidadResiembras = \DB::table('resowing_trackings')
            ->join('resowings', 'resowing_trackings.resowing_id', '=', 'resowings.id')
            ->join('resowing_lot', 'resowings.id', '=', 'resowing_lot.resowing_id')
            ->where('resowing_lot.lot_id', $this->id)
            ->sum('resowing_trackings.mortality');

        return [
            'capacity' => $this->capacity,
            'ocupadoCultivos' => $ocupadoCultivos,
            'ocupadoResiembras' => $ocupadoResiembras,
            'mortalidadPlantas' => $mortalidadPlantas,
            'mortalidadPeces' => $mortalidadPeces,
            'mortalidadResiembras' => $mortalidadResiembras,
            'ocupadoTotal' => $this->ocupado,
            'disponible' => $this->disponible,
        ];
    }

    public function aquaponicSystem()
    {
        return $this->belongsTo(AquaponicSystem::class, 'aquaponic_system_id');
    }

    protected static function newFactory()
    {
        return \Modules\ACUAPONICO\Database\factories\LotFactory::new();
    }
}