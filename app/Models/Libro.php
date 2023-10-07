<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'libros';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class);
    }

    public function clientes(): BelongsToMany
    {
        return $this->belongsToMany(Cliente::class)->withPivot('fechaCompra');
    }
}
