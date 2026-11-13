<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    public const ORIGINS = ['chinese', 'korean', 'japanese', 'english'];

    public const STATUSES = ['reading', 'planned', 'completed', 'dropped'];

    protected $fillable = [
        'title', 'author', 'origin', 'status',
        'chapters_read', 'total_chapters', 'rating', 'is_favourite',
    ];

    protected function casts(): array
    {
        return [
            'is_favourite' => 'boolean',
            'rating' => 'decimal:1',
        ];
    }
}
