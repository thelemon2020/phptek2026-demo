<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MirrorLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['method', 'uri', 'headers', 'ip', 'created_at'];

    protected function casts(): array
    {
        return [
            'headers' => 'array',
            'created_at' => 'datetime',
        ];
    }
}
