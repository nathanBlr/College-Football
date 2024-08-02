<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'divisions';
    protected $fillable = [
        'name',
        'organization_id',
        'slug',
        'simble',
        'history',
        'logo',
        'creation_date',
        'country',
        'hex1',
        'hex2',
        'hex3',
        'state',
        'city',
        'website',
        'email',
        ];
        public function organization(): BelongsTo
        {
            return $this->belongsTo(Organization::class);
        }
        public function conferences(): HasMany
        {
            return $this->hasMany(Conference::class);
        }
}
