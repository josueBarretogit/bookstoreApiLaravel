<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'libros';
    protected $primaryKey = 'libro_id';
    public $timestamps = false;

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class);
    }
}
