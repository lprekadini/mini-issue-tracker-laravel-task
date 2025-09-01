<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','start_date','deadline'];

    protected $casts = [
        'start_date' => 'date',
        'deadline'   => 'date',
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}