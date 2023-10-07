<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cuenta(): HasOne
    {
        return $this->hasOne(Cuenta::class);
    }

    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class)->withPivot('fechaCompra');
    }
}
