<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Auth;
trait HasAuditColumns
{
    protected static function bootHasAuditColumns(): void {
        //auto marcado para el create
        static::creating(function ($model){
            if(Auth::check()){
                if(!$model->isDirty('created_by')){
                    $model->created_by = Auth::id();
                }

                 if (!$model->isDirty('updated_by')) {
                    $model->updated_by = Auth::id();
                }
            }
        });

        static::updating(function ($model){
            if(Auth::check()){
                if(!$model->isDirty('updated_by')){
                    $model->updated_by = Auth::id();
                }
            }
        });
    }
}
