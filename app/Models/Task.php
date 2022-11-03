<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['body', "completed"];


    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo(Project::class, "id_project", "id");
    }
}
