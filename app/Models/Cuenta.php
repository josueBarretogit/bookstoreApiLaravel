<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cuenta extends Authenticatable
{
    use HasFactory;
    use Notifiable;

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
