<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    // Accessors pour les statistiques de progression

    public function getMasteredConceptsCountAttribute()
    {
        return $this->concepts()->where('status', 'mastered')->count();
    }
   
    // Total de concepts dans ce domaine
    public function getTotalConceptsCountAttribute()
    {
        return $this->concepts()->count();
    }

    
    // Pourcentage de progression (concepts maîtrisés / total concepts)
    public function getProgressPercentageAttribute()
    {
        if ($this->total_concepts_count === 0) {
            return 0;
        }
        
        return round(($this->mastered_concepts_count / $this->total_concepts_count) * 100);
    }
}