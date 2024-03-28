<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'values',
        'trimester',
    ];

    public function students() {
        return $this->belongsTo(Student::class);
    }

    public function schoolYear() {
        return $this->belongsTo(SchoolYear::class);
    }
}
