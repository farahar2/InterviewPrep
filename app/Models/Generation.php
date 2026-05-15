<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept_id',
        'questions',
    ];

    protected $casts = [
        'questions' => 'array',
    ];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }
}