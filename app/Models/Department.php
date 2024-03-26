<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function exam_managers(){
        return $this->hasMany(ExamManager::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
}
