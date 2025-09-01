<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    public const STATUSES = ['open','in_progress','closed'];
    public const PRIORITIES = ['low','medium','high'];

    protected $fillable = [
        'project_id','title','description','status','priority','due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function comments() { return $this->hasMany(Comment::class)->latest(); }
    public function tags() { return $this->belongsToMany(Tag::class); }
}