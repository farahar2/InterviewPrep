<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concept extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'domain_id',
        'title',
        'explanation',
        'difficulty',
        'status',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function generations()
    {
        return $this->hasMany(Generation::class);
    }

  
     // ACCESSOR: Format difficulty for display
    public function getFormattedDifficultyAttribute()
    {
        return match($this->difficulty) {
            'junior' => 'Junior',
            'mid' => 'Mid',
            'senior' => 'Senior',
        };
    }
     // ACCESSOR: Format status for display

    public function getFormattedStatusAttribute()
    {
        return match($this->status) {
            'to_review' => 'To Review',
            'in_progress' => 'In Progress',
            'mastered' => 'Mastered',
        };
    }

     // ACCESSOR: Get status color for badges
     
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'to_review' => 'status-review',    // Red
            'in_progress' => 'status-progress', // Orange
            'mastered' => 'status-mastered',    // Green
        };
    }

  
     // ACCESSOR: Get difficulty color for badges
  
    public function getDifficultyColorAttribute()
    {
        return match($this->difficulty) {
            'junior' => 'difficulty-junior',   // Green
            'mid' => 'difficulty-mid',         // Orange
            'senior' => 'difficulty-senior',   // Red
        };
    }

     // SCOPE: Filter by status
    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    
     // SCOPE: Filter by difficulty
    public function scopeByDifficulty($query, $difficulty)
    {
        if ($difficulty) {
            return $query->where('difficulty', $difficulty);
        }
        return $query;
    }
}