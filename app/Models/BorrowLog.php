<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'student_id',
        'is_returned'
    ];
    
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
