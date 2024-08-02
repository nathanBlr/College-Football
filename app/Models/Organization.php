<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'organizations';
    protected $fillable = [
        'name',
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
    public function divisions(){
        return $this->hasMany(Division::class);
    }
}
