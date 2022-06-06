<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    // Minden mező engedelyézese, kivéve...
    protected $guarded = [];  

    // Időbélyeg használata (updated_at és created_at mezők a táblában)
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function quiz_result()
    {
        return $this->belongsTo('App\Models\Quiz_result');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\QuizType');
    }
}
