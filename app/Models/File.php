<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'file_description'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
