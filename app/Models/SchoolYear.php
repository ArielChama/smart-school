<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $table = 'school_year';

    protected $fillable = [
        'initial',
        'final'
    ];

    public function classes() {
        return $this->hasMany(Classe::class);
    }

    public function classifications() {
        return $this->belongsTo(Classification::class);
    }
}
