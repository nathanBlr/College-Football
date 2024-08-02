<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conference extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'conferences';
    protected $fillable = [
        'name',
        'slug',
        'division_id',
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
        public function division(){
            return $this->belongsTo(Division::class);
        }
        public function teams(){
            return $this->hasMany(Team::class);
        }
}
