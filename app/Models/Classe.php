<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter',
        'shift',
        'grade',
        'course'
    ];

    protected $casts = [
        'lesson' => 'json',
    ];

    public function schoolYear() {
        return $this->belongsTo(SchoolYear::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('lesson');
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'classe_student', 'classe_id', 'student_id');
    }
}