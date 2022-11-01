<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'id_owner'
    ];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'id_owner');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'id_project', 'id');
    }

    public function path()
    {
        return "/projects/{$this->id}";
    }
    
}
