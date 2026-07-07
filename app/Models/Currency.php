<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    use HasFactory;
    protected $fillable = [
        'code',
        'currency_rate',
        'country',
        'created_by',
        'updated_by',
    ];

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper(trim($value)),
        );
    }

    public function ratesAsSource(): HasMany
    {
        return $this->hasMany(CurrencyRate::class, 'from_currency_id');
    }

    public function ratesAsTarget(): HasMany
    {
        return $this->hasMany(CurrencyRate::class, 'to_currency_id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(){
        return $this->belongsTo(User::class, 'updated_by');
    }

}
