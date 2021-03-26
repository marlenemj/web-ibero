<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Esto permite asignación masiva
    protected $fillable = [
    	'user_id','name','description', 'status', 'due_date', 'project_id'
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
