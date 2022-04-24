<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'term'
    ];

    
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function marks()
    {
        return $this->hasMany(mark::class, 'exam_id');
    }
}
