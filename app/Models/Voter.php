<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Voter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn', 'name', 'class', 'major', 'token', 'has_voted',
    ];

    protected static function booted(): void
{
    static::creating(function ($voter) {
        // Token pendek 8 karakter, huruf dan angka
        $voter->token = strtoupper(Str::random(8));
    });
}

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }
}
