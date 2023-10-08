<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autores';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'aboutDescripcion', 'apellidos', 'foto'];
    public $timestamps = false;

    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class);
    }

    public function cuenta(): HasOne
    {
        return $this->hasOne(Cuenta::class);
    }
}
