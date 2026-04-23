<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    protected $fillable = [
        'original_name',
        'file_path',
        'entity_id',
        'entity_type'
    ];

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}