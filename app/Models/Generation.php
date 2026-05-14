<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'concept_id',
        'questions',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'questions' => 'array', // Automatically convert JSON to array
    ];

    /**
     * RELATION: A generation belongs to a concept
     */
    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    /**
 * RELATION: A concept has many AI-generated question sets
 */
public function generations()
{
    return $this->hasMany(Generation::class);
}
}