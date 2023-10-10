<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = ['nombreRol'];
    public $timestamps = false;

    public function permiso(): BelongsTo
    {
        return $this->belongsTo(Permiso::class);
    }

    public function cuentas(): HasMany
    {
        return $this->hasMany(Cuenta::class);
    }
}
