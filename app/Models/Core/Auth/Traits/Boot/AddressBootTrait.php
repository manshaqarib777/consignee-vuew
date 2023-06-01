<?php


namespace App\Models\Core\Auth\Traits\Boot;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

trait AddressBootTrait
{
        
    protected static function booted(): void
    {
        static::addGlobalScope('createdBy', function (Builder $builder) {
            if (!Auth::user()->isAppAdmin()){
                $builder->whereHas('consignee', function (Builder $query) {
                    $query->where('created_by', auth()->id());
                });
            }
        });
    }
}
