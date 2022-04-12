<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'type'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
