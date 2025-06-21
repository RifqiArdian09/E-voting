<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'vision', 'mission', 'photo',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
