<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\Country;
class Team extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'teams';
    protected $fillable = [
        'name',
        'conferences_id',
        'stadium_id',
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
        public function conference(){
            return $this->belongsTo(Conference::class, 'conferences_id');
        }
        public function stadium(){
            return $this->belongsTo(Stadium::class);
        }
}
