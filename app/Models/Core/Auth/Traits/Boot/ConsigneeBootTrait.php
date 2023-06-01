<?php


namespace App\Models\Core\Auth\Traits\Boot;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

trait ConsigneeBootTrait
{
        
    protected static function booted(): void
    {
        static::addGlobalScope('createdBy', function (Builder $builder) {
            if (!Auth::user()->isAppAdmin()){
                $builder->where('created_by', auth()->id());
            }
        });
    }

    public static function boot() : void
    {
        parent::boot();
        static::creating(function($model){
            return $model->fill([
                'created_by' => auth()->id()
            ]);
        });
    }
}
