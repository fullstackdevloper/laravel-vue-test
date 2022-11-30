<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'answer'];

    public function options()
    {
        return $this->hasMany('App\Models\QuestionOption');
    }
    public function answers()
    {
        return $this->belongsTo(QuestionOption::class, 'answer');
    }
    public function userOptions()
    {

        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
