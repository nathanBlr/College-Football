<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class Stadium extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stadium';
    protected $fillable = [
        'name',
        'full_name',
        'nickname',
        'slug',
        'photo',
        'history',
        'capacity',
        'surface',
        'year_built',
        'location',
        'country',
        'state',
        'city',
        ];
        public function country(): BelongsTo
        {
            return $this->belongsTo(Country::class);
        }
        public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function citie(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
