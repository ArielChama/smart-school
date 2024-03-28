<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'birthday',
        'number_phone',
        'number_bi',
        'gender',
        'address',
        'nationality',
        'process_number',
        'language_option',
        'course',
        'image'
    ];

    public function classes() {
        return $this->belongsToMany(Classe::class);
    }

    public function classifications() {
        return $this->hasMany(Classification::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
