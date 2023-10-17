<?php

namespace App\Models;

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cuenta extends Authenticatable
{
    use HasFactory;

    use HasApiTokens;
    protected $table = 'cuentas';
    protected $primaryKey = 'id';
    protected $fillable = ['correo', 'contrasena'];
    public $timestamps = false;

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Rol::class);
    }
}
