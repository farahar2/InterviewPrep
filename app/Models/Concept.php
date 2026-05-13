<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concept extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'domain_id',
        'title',
        'explanation',
        'difficulty',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function generations()
    {
        return $this->hasMany(Generation::class);
    }

    public function getFormattedDifficultyAttribute()
    {
        return match($this->difficulty) {
            'junior' => 'Junior',
            'mid' => 'Mid',
            'senior' => 'Senior',
        };
    }

    public function getFormattedStatusAttribute()
    {
        return match($this->status) {
            'to_review' => 'To Review',
            'in_progress' => 'In Progress',
            'mastered' => 'Mastered',
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'to_review' => 'status-review',
            'in_progress' => 'status-progress',
            'mastered' => 'status-mastered',
        };
    }

    public function getDifficultyColorAttribute()
    {
        return match($this->difficulty) {
            'junior' => 'difficulty-junior',
            'mid' => 'difficulty-mid',
            'senior' => 'difficulty-senior',
        };
    }

    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopeByDifficulty($query, $difficulty)
    {
        if ($difficulty) {
            return $query->where('difficulty', $difficulty);
        }
        return $query;
    }
}
